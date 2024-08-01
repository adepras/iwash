<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    // Cuci Mobil
    public function menu()
    {
        return view('menu.menu');
    }

    // Satu Kali Cuci
    public function menu1(Request $request)
    {
        $vehicles = Vehicle::where('user_id', auth()->id())->get();
        $date = $request->get('date_booking', Carbon::today());
        $slots = $this->getAvailableSlots($date);

        return view('menu.menu_first', compact('vehicles', 'slots'));
    }

    // Salon Mobil dan Detailing
    public function menu2(Request $request)
    {
        $vehicles = Vehicle::where('user_id', auth()->id())->get();
        $date = $request->get('date_booking', Carbon::today());
        $slots = $this->getAvailableSlots($date);

        return view('menu.menu_second', compact('vehicles'));
    }

    private function getAvailableSlots($date)
    {
        $start = Carbon::createFromTime(8, 0);
        $end = Carbon::createFromTime(16, 0);
        $interval = 60;
        $slots = [];

        for ($time = $start->copy(); $time->lessThan($end); $time->addMinutes($interval)) {
            $slots[$time->format('H:i')] = true;
        }

        $bookings = Booking::whereDate('booking_date', $date)->get();

        foreach ($bookings as $booking) {
            $bookingStart = Carbon::parse($booking->booking_date)->format('H:i');
            if (isset($slots[$bookingStart])) {
                $slots[$bookingStart] = false;
            }
        }

        return $slots;
    }
}
