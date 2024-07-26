<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimoni;

class HomeController extends Controller
{
    // Testiomoni
    public function index()
    {
        $testimoni = Testimoni::all();

        return view('home.home', compact('testimoni'));
    }
    // Harga
    public function price()
    {
        return view('home.price');
    }
    // Tentang Kami
    public function about()
    {
        return view('home.about');
    }
    // Detailing Mobil
    public function pack()
    {
        return view('home.pack');
    }
}
