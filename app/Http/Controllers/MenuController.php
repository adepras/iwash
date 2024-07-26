<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function menu()
    {
        return view('menu.menu');
    }

    public function menu1()
    {
        return view('menu.menu_first');
    }

    public function menu2()
    {
        return view('menu.menu_second');
    }

    public function menu3()
    {
        return view('menu.menu_third');
    }


    public function showWashPage()
    {
        $vehicles = auth()->user()->vehicles;

        return view('menu.menu_first', compact('vehicles'));
    }
}
