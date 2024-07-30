<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'service' => 'required',
            'package' => 'required',
            'price' => 'required|numeric',
            'estimated' => 'required|integer',
            'date_booking' => 'required|date',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $existingBooking = Booking::where('vehicle_id', $request->input('vehicle_id'))
            ->where('status', '!=', 'finished')
            ->first();

        if ($existingBooking) {
            return redirect()->back()->withErrors(['vehicle_id' => 'Kendaraan ini sudah di dalam pemesanan layanan.']);
        }

        $queueNumber = Booking::whereDate('booking_date', $validated['date_booking'])->max('queue_number') + 1;
        $formattedQueueNumber = sprintf('%03d', $queueNumber);

        $booking = new Booking([
            'queue_number' => $formattedQueueNumber,
            'service' => $request->input('service'),
            'package' => $request->input('package'),
            'price' => $request->input('price'),
            'estimated' => $request->input('estimated'),
            'booking_date' => Carbon::parse($request->input('date_booking')),
            'user_id' => $user->id,
            'name' => $user->name,
            'phone_number' => $user->phone_number,
            'vehicle_id' => $request->input('vehicle_id'),
            'status' => 'pending',
        ]);

        $booking->save();

        return redirect()->route('detail_order', ['id' => $booking->id])->with('success', 'Booking berhasil dibuat!');
    }

    public function show($id)
    {
        $booking = Booking::with('vehicle')->findOrFail($id);

        $user = User::find($booking->user_id);

        $date_booking = Carbon::parse($booking->booking_date)->format('d M Y');

        $phone_number = $user->phone_number;
        $sensor_phone_number = substr($phone_number, 0, 4) . str_repeat('*', strlen($phone_number) - 7) . substr($phone_number, -3);

        return view('menu.detail_order', [
            'booking' => $booking,
            'service' => $booking->service,
            'package' => $booking->package,
            'price' => $booking->price,
            'estimated' => $booking->estimated,
            'date_booking' => $date_booking,
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
