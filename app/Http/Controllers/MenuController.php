<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('menu.menu_first');
    }

    // Salon Mobil dan Detailing
    public function menu2()
    {
        return view('menu.menu_second');
    }
    
    // Order
    public function detail_order()
    {
        return view('menu.detail_order');
    }

    // public function showWashPage()
    // {
    //     $vehicles = auth()->user()->vehicles;

    //     return view('menu.menu_first', compact('vehicles'));
    // }
}
