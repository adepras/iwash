<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Midtrans\Snap;
use App\Models\Slot;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Booking;
use Midtrans\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $vehicles = $user->vehicles;
        $outlet = Outlet::find(1);
        $slots = $this->generateSlots($outlet);

        return view('menu_first', compact('vehicles', 'slots'));
    }

    private function generateSlots($outlet, $date = null)
    {
        $openingTime = Carbon::parse($outlet->opening_time);
        $closingTime = Carbon::parse($outlet->closing_time);
        $currentDate = $date ? Carbon::parse($date) : Carbon::now()->toDateString();

        $slots = [];

        while ($openingTime < $closingTime) {
            $endSlotTime = $openingTime->copy()->addHour();
            $slot = Slot::firstOrCreate([
                'outlet_id' => $outlet->id,
                'date' => $currentDate,
                'start_time' => $openingTime->toTimeString(),
                'end_time' => $endSlotTime->toTimeString(),
            ], [
                'booked' => false,
            ]);

            $slots[$openingTime->format('H:i')] = !$slot->booked;

            $openingTime->addHour();
        }

        return $slots;
    }

    public function store(Request $request)
    {
        // Menyimpan data booking yang telah divalidasi ke session
        $validated = $request->validate([
            'service' => 'required',
            'package' => 'required',
            'price' => 'required|numeric',
            'estimated' => 'required|integer',
            'date_booking' => 'required|date',
            'time_booking' => 'required|date_format:H:i',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        // Simpan data booking sementara untuk kemudian dicek
        $booking = new Booking([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'service' => $validated['service'],
            'package' => $validated['package'],
            'price' => $validated['price'],
            'estimated' => $validated['estimated'],
            'booking_date' => $validated['date_booking'],
            'time_booking' => $validated['time_booking'],
            'user_id' => $validated['vehicle_id'],
            'name' => Auth::user()->name,
            'phone_number' => Auth::user()->phone_number,
            'vehicle_id' => $validated['vehicle_id'],
            'status' => 'pending',
        ]);

        $booking->save();

        // Simpan data booking ke dalam session
        session([
            'validated_booking_data' => $validated,
            'user_id' => Auth::id(),
        ]);

        // Arahkan ke halaman loading
        return redirect()->route('loading');
    }

    public function processBooking(Request $request)
    {
        $validated = session('validated_booking_data');

        if (!$validated) {
            return redirect()->route('menu1')->withErrors(['time_booking' => 'Sesi telah berakhir, silakan ulangi proses booking']);
        }

        $dateBooking = Carbon::parse($validated['date_booking'])->toDateString();
        $timeBooking = Carbon::parse($validated['time_booking'])->toTimeString();

        DB::beginTransaction();

        try {
            // Cari data booking yang paling baru (dalam 5 detik terakhir)
            $currentTimestamp = Carbon::now();
            $startTimestamp = $currentTimestamp->copy()->subSeconds(5);

            $recentBookings = Booking::where('booking_date', $dateBooking)
                ->whereBetween('created_at', [$startTimestamp, $currentTimestamp])
                ->get();

            // Urutkan booking berdasarkan estimated duration (untuk menerapkan algoritma Shortest Job First)
            $sortedBookings = $recentBookings->sortBy('estimated');

            // Ambil data booking pada sortedBookings yang memiliki estimated duration paling kecil
            $bookingData = $sortedBookings->first();

            // Cek dan buat slot berdasarkan estimated duration
            $slots = $this->checkAndCreateSlotsBasedOnEstimated($bookingData->booking_date, $bookingData->time_booking, $bookingData->estimated);

            // Tandai slot yang dipilih sebagai booked
            foreach ($slots as $slot) {
                $slot->booked = true;
                $slot->save();
            }

            // Simpan data booking
            $booking = new Booking([
                'id' => (string) \Illuminate\Support\Str::uuid(),
                'service' => $bookingData->service,
                'package' => $bookingData->package,
                'price' => $bookingData->price,
                'estimated' => $bookingData->estimated,
                'booking_date' => $bookingData->booking_date,
                'time_booking' => $bookingData->time_booking,
                'user_id' => $bookingData->user_id,
                'name' => $bookingData->name,
                'phone_number' => $bookingData->phone_number,
                'vehicle_id' => $bookingData->vehicle_id,
                'status' => 'pending',
            ]);

            $booking->save();

            // Sesuaikan slot dengan booking
            foreach ($slots as $slot) {
                $slot->booking_id = $booking->id;
                $slot->save();
            }

            DB::commit();

            // Hapus data booking yang disimpan di session
            session()->forget('validated_booking_data');

            // Jika user pada data booking sama dengan user yang sedang login, maka diarahkan ke halaman detail_order
            if ($booking->user_id == Auth::id()) {
                return redirect()->route('detail_order', ['id' => $booking->id]);
            } else {
                // Jika user pada data booking tidak sama dengan user yang sedang login, maka diarahkan untuk kembali 
                return redirect()->route('menu1')->withErrors(['time_booking' => 'Tidak ada slot waktu yang tersedia']);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('menu1')->withErrors(['time_booking' => 'Terjadi kesalahan : ' . $e->getMessage()]);
        }
    }


    private function checkAndCreateSlotsBasedOnEstimated($dateBooking, $timeBooking, $estimated)
    {
        $slots = [];

        // Iterate through all outlets to find available slots
        for ($outletId = 1; $outletId <= Outlet::count(); $outletId++) {
            $outlet = Outlet::find($outletId);
            $slot = Slot::where('date', $dateBooking)
                ->where('start_time', $timeBooking)
                ->where('outlet_id', $outlet->id)
                ->first();

            // If slot not found, generate new slots for the date
            if (!$slot) {
                $this->generateSlots($outlet, $dateBooking);
                $slot = Slot::where('date', $dateBooking)
                    ->where('start_time', $timeBooking)
                    ->where('outlet_id', $outlet->id)
                    ->first();
            }

            // If slot is found and not booked, add it to slots array
            if ($slot && !$slot->booked) {
                $slots[] = $slot;

                if ($estimated == 60) {
                    break;
                } elseif ($estimated == 120) {
                    $nextTime = Carbon::parse($timeBooking)->addMinutes(60)->toTimeString();
                    $nextSlot = Slot::where('date', $dateBooking)
                        ->where('start_time', $nextTime)
                        ->where('outlet_id', $outlet->id)
                        ->first();
                    if ($nextSlot && !$nextSlot->booked) {
                        $slots[] = $nextSlot;
                    }
                    break;
                } elseif ($estimated == 180) {
                    $nextTime = Carbon::parse($timeBooking)->addMinutes(60)->toTimeString();
                    $nextTime2 = Carbon::parse($timeBooking)->addMinutes(120)->toTimeString();
                    $nextSlot = Slot::where('date', $dateBooking)
                        ->where('start_time', $nextTime)
                        ->where('outlet_id', $outlet->id)
                        ->first();
                    $nextSlot2 = Slot::where('date', $dateBooking)
                        ->where('start_time', $nextTime2)
                        ->where('outlet_id', $outlet->id)
                        ->first();
                    if ($nextSlot && !$nextSlot->booked) {
                        $slots[] = $nextSlot;
                        if ($nextSlot2 && !$nextSlot2->booked) {
                            $slots[] = $nextSlot2;
                        }
                    }
                    break;
                }
            }
        }

        return $slots;
    }

    public function show($id)
    {
        $booking = Booking::with('vehicle')->findOrFail($id);

        $user = User::find($booking->user_id);

        $date_booking = Carbon::parse($booking->booking_date)->format('d M Y');
        $time_booking = Carbon::parse($booking->time_booking)->format('H:i');

        $phone_number = $user->phone_number;
        $sensor_phone_number = substr($phone_number, 0, 4) . str_repeat('*', strlen($phone_number) - 7) . substr($phone_number, -3);

        return view('menu.detail_order', [
            'booking' => $booking,
            'service' => $booking->service,
            'package' => $booking->package,
            'price' => $booking->price,
            'estimated' => $booking->estimated,
            'date_booking' => $date_booking,
            'time_booking' => $time_booking,
            'name' => $user->name,
            'phone_number' => $sensor_phone_number,
            'vehicle' => $booking->vehicle,
            'status' => $booking->status,
        ]);
    }

    public function createBooking(Request $request)
    {
        $service = 'Nama Layanan';
        $package = 'Nama Paket';
        $price = 100000;
        $estimated = 60;
        $date_booking = now();
        $vehicle_id = 1;

        return view(
            'menu.detail_order',
            compact(
                'service',
                'package',
                'price',
                'estimated',
                'date_booking',
                'vehicle_id',
                'status'
            )
        );
    }

    public function detailOrder($id)
    {
        $booking = Booking::with('vehicle')->findOrFail($id);
        $user = User::find($booking->user_id);

        $date_booking = Carbon::parse($booking->booking_date)->format('d M Y');
        $time_booking = Carbon::parse($booking->time_booking)->format('H:i');
        $phone_number = $user->phone_number;
        $sensor_phone_number = substr($phone_number, 0, 4) . str_repeat('*', strlen($phone_number) - 7) . substr($phone_number, -3);

        $params = [
            'transaction_details' => [
                'order_id' => $booking->id,
                'gross_amount' => $booking->price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'last_name' => '',
                'email' => $user->email,
                'phone' => $user->phone_number,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('detail_order', [
            'booking' => $booking,
            'snapToken' => $snapToken,
            'date_booking' => $date_booking,
            'time_booking' => $time_booking,
            'name' => $user->name,
            'phone_number' => $sensor_phone_number,
            'service' => $booking->service,
            'package' => $booking->package,
            'estimated' => $booking->estimated,
            'status' => $booking->status,
        ]);
    }

    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status === 'pending') {
            $booking->status = 'canceled';
            $booking->save();

            // Notification::send($booking->user, new BookingCanceledNotification($booking));
        }

        return redirect()->route('profile')->with('status', 'Booking has been canceled.');
    }

    public function queue()
    {
        $bookings = Booking::where('status', 'pending')->get();
        return view('admin.menu.queues', compact('bookings'));
    }

    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())->get();
        return view('admin.menu.bookings', compact('bookings'));
    }

    public function today()
    {
        $bookings = Booking::where('booking_date', Carbon::today())->get();
        return view('admin.menu.bookings', compact('bookings'));
    }
}
