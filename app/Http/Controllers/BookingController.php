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
    
        // Fungsi untuk memeriksa dan membuat slot jika belum ada
        $slot = $this->checkAndCreateSlots($outlet, $dateBooking, $timeBooking);
    
        // Ambil semua booking yang dibuat dalam 5 detik terakhir
        $currentTimestamp = Carbon::now();
        $startTimestamp = $currentTimestamp->copy()->subSeconds(5);
    
        $recentBookings = Booking::where('booking_date', $dateBooking)
            ->whereBetween('created_at', [$startTimestamp, $currentTimestamp])
            ->get();
    
        // Tambahkan booking saat ini ke dalam list recentBookings
        $recentBookings->push((object) [
            'id' => null,
            'user_id' => $user->id,
            'vehicle_id' => $validated['vehicle_id'],
            'service' => $validated['service'],
            'package' => $validated['package'],
            'price' => $validated['price'],
            'estimated' => $validated['estimated'],
            'date_booking' => $dateBooking,
            'time_booking' => $timeBooking,
            'status' => 'pending',
            'created_at' => $currentTimestamp,
        ]);
    
        // Urutkan booking berdasarkan estimasi durasi (SJF)
        $sortedBookings = $recentBookings->sortBy('estimated');
    
        foreach ($sortedBookings as $bookingData) {
            if ($bookingData->id == null) {
    
                $booking = new Booking([
                    'id' => (string) \Illuminate\Support\Str::uuid(),
                    'service' => $bookingData->service,
                    'package' => $bookingData->package,
                    'price' => $bookingData->price,
                    'estimated' => $bookingData->estimated,
                    'booking_date' => $dateBooking,
                    'time_booking' => $timeBooking,
                    'user_id' => $bookingData->user_id,
                    'name' => $user->name,
                    'phone_number' => $user->phone_number,
                    'vehicle_id' => $bookingData->vehicle_id,
                    'status' => 'pending',
                ]);
    
                // Periksa ketersediaan slot berdasarkan nilai estimated
                $slots = $this->getSlotsBasedOnEstimated($outlet->id, $dateBooking, $timeBooking, $bookingData->estimated);
    
                foreach ($slots as $slot) {
                    if ($slot->booked) {
                        foreach ($sortedBookings as $bookingDataOld) {
                            if ($bookingDataOld->id !== null && $bookingDataOld->id !== $booking->id) {
                                // Ini adalah booking yang sudah ada dalam daftar recentBookings, perbarui status dan slot
                                $existingBooking = Booking::find($bookingDataOld->id);
                                if ($existingBooking) {
                                    // Tandai slot lama yang terkait dengan booking ini sebagai tidak tersedia
                                    $timeBookingOld = Carbon::parse($timeBooking)->addMinutes($bookingData->estimated)->toTimeString();
                                    $oldSlots = Slot::where('booking_id', $existingBooking->id)->get();
                                    foreach ($oldSlots as $slot) {
                                        $slot->booked = false;
                                        $slot->booking_id = null;
                                        $slot->save();
                                    }
    
                                    // Update booking dengan informasi baru
                                    $existingBooking->service = $bookingDataOld->service;
                                    $existingBooking->package = $bookingDataOld->package;
                                    $existingBooking->price = $bookingDataOld->price;
                                    $existingBooking->estimated = $bookingDataOld->estimated;
                                    $existingBooking->booking_date = $dateBooking;
                                    $existingBooking->time_booking = $timeBookingOld;
                                    $existingBooking->user_id = $bookingDataOld->user_id;
                                    $existingBooking->name = $bookingDataOld->name;
                                    $existingBooking->phone_number = $bookingDataOld->phone_number;
                                    $existingBooking->vehicle_id = $bookingDataOld->vehicle_id;
                                    $existingBooking->status = 'pending';
    
                                    // Periksa ketersediaan slot berdasarkan nilai estimated
                                    $slotsNew = $this->getSlotsBasedOnEstimated($outlet->id, $dateBooking, $timeBookingOld, $existingBooking->estimated);
    
                                    foreach ($slotsNew as $slot) {
                                        if ($slot->booked) {
                                            return redirect()->back()->withErrors(['time_booking' => 'Slot waktu tidak tersedia atau sudah dipesan']);
                                        }
                                    }
    
                                    // Tandai slot-slot yang dipilih sebagai sudah dipesan
                                    foreach ($slotsNew as $slot) {
                                        $slot->booked = true;
                                        $slot->booking_id = $existingBooking->id;
                                        $slot->save();
                                    }
                                    $existingBooking->save();
                                }
                            }
                        }
                    }
                }
    
                // Tandai slot-slot yang dipilih sebagai sudah dipesan
                foreach ($slots as $slot) {
                    $slot->booked = true;
                    $slot->save();
                }
    
                $booking->save();
    
                foreach ($slots as $slot) {
                    $slot->booking_id = $booking->id;
                    $slot->save();
                }
            }
        }
    
        return redirect()->route('detail_order', ['id' => $booking->id])
            ->with('success', 'Booking berhasil dibuat! Slot waktu: ' . $timeBooking);
    }
    

    private function checkAndCreateSlots($outlet, $dateBooking, $timeBooking)
    {
        $slot = Slot::where('date', $dateBooking)
            ->where('start_time', $timeBooking)
            ->where('outlet_id', $outlet->id)
            ->first();
        if (!$slot) {
            $this->generateSlots($outlet, $dateBooking);
            $slot = Slot::where('date', $dateBooking)
                ->where('start_time', $timeBooking)
                ->where('outlet_id', $outlet->id)
                ->first();
        }
        return $slot;
    }

    private function getSlotsBasedOnEstimated($outletId, $dateBooking, $timeBooking, $estimated)
    {
        $slots = [];
        $slot = Slot::where('date', $dateBooking)
            ->where('start_time', $timeBooking)
            ->where('outlet_id', $outletId)
            ->first();

        if ($estimated == 60) {
            $slots[] = $slot;
        } elseif ($estimated == 120) {
            $slots[] = $slot;
            $nextTime = Carbon::parse($timeBooking)->addMinutes(60)->toTimeString();
            $nextSlot = Slot::where('date', $dateBooking)
                ->where('start_time', $nextTime)
                ->where('outlet_id', $outletId)
                ->first();
            if ($nextSlot) {
                $slots[] = $nextSlot;
            }
        } elseif ($estimated == 180) {
            $slots[] = $slot;
            $nextTime = Carbon::parse($timeBooking)->addMinutes(60)->toTimeString();
            $nextTime2 = Carbon::parse($timeBooking)->addMinutes(120)->toTimeString();
            $nextSlot = Slot::where('date', $dateBooking)
                ->where('start_time', $nextTime)
                ->where('outlet_id', $outletId)
                ->first();
            $nextSlot2 = Slot::where('date', $dateBooking)
                ->where('start_time', $nextTime2)
                ->where('outlet_id', $outletId)
                ->first();
            if ($nextSlot) {
                $slots[] = $nextSlot;
                if ($nextSlot2) {
                    $slots[] = $nextSlot2;
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
