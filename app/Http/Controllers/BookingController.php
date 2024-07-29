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

        $booking = Booking::create([
            'service' => $request->input('service'),
            'package' => $request->input('package'),
            'price' => $request->input('price'),
            'estimated' => $request->input('estimated'),
            'booking_date' => Carbon::parse($request->input('booking_date'))->format('Y-m-d'),
            'user_id' => $user->id,
            'name' => $user->name,
            'phone_number' => $user->phone_number,
            'vehicle_brand' => $request->input('vehicle_brand'),
            'vehicle_type' => $request->input('vehicle_type'),
            'license_plate' => $request->input('license_plate'),
            'status' => 'waiting'
        ]);

        return redirect()->route('detail_order', ['id' => $booking->id])->with('success', 'Pemesanan berhasil dibuat.');
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);

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
            'vehicle_brand' => $booking->vehicle_brand,
            'vehicle_type' => $booking->vehicle_type,
            'license_plate' => $booking->license_plate,
        ]);
    }

    public function createBooking(Request $request)
    {
        $service = 'Nama Layanan';
        $package = 'Nama Paket';
        $price = 100000;
        $estimated = 60;
        $date_booking = now();
        $vehicle_brand = 'Toyota';
        $vehicle_type = 'SUV';
        $license_plate = 'B 1234 ABC';

        return view(
            'menu.detail_order',
            compact(
                'service',
                'package',
                'price',
                'estimated',
                'date_booking',
                'vehicle_brand',
                'vehicle_type',
                'license_plate'
            )
        );
    }

}
