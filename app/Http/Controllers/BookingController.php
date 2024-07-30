<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Slot;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        $validated = $request->validate([
            'service' => 'required',
            'package' => 'required',
            'price' => 'required|numeric',
            'estimated' => 'required|integer',
            'date_booking' => 'required|date',
            'time_booking' => 'required|date_format:H:i',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $dateBooking = Carbon::parse($validated['date_booking'])->toDateString();
        $timeBooking = Carbon::parse($validated['time_booking'])->toTimeString();
        $outlet = Outlet::find(1);

        $slot = Slot::where('date', $dateBooking)
            ->where('start_time', $timeBooking)
            ->where('outlet_id', $outlet->id)
            ->first();

        if (!$slot || $slot->booked) {
            return redirect()->back()->withErrors(['time_booking' => 'Slot waktu tidak tersedia atau sudah dipesan']);
        }

        $slot->booked = true;
        $slot->save();

        $queueNumber = Booking::whereDate('booking_date', $validated['date_booking'])->max('queue_number') + 1;
        $formattedQueueNumber = sprintf('%03d', $queueNumber);

        $booking = new Booking([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'queue_number' => $formattedQueueNumber,
            'service' => $validated['service'],
            'package' => $validated['package'],
            'price' => $validated['price'],
            'estimated' => $validated['estimated'],
            'booking_date' => $dateBooking,
            'time_booking' => $timeBooking,
            'user_id' => $user->id,
            'name' => $user->name,
            'phone_number' => $user->phone_number,
            'vehicle_id' => $validated['vehicle_id'],
            'status' => 'pending',
        ]);

        $booking->save();

        $slot->booking_id = $booking->id; // Menggunakan UUID
        $slot->save();

        return redirect()->route('detail_order', ['id' => $booking->id])
            ->with('success', 'Booking berhasil dibuat! Slot waktu: ' . $slot->start_time);
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
        $booking = Booking::findOrFail($id);
        return view('menu.detail_order', compact('booking'));
    }

    // public function cancelBooking($id)
    // {
    //     $booking = Booking::findOrFail($id);
    //     $booking->status = 'Cancelled';
    //     $booking->save();

    //     return redirect()->back()->with('status', 'Pemesanan Layanan Anda Dibatalkan');
    // }
}
