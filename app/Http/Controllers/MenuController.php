<?php

namespace App\Http\Controllers;

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
    public function menu1()
    {
        $vehicles = Vehicle::where('user_id', auth()->id())->get();

        return view('menu.menu_first', compact('vehicles'));
    }

    // Salon Mobil dan Detailing
    public function menu2()
    {
        $vehicles = Vehicle::where('user_id', auth()->id())->get();

        return view('menu.menu_second', compact('vehicles'));
    }

    // Order
    public function detail_order()
    {
        return view('menu.detail_order');
    }
}
