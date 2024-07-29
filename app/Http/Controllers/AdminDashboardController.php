<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah total pengguna
        $userCount = User::count();

        // Menghitung jumlah pemesanan yang dibuat hari ini
        $todayBookingsCount = Booking::whereDate('created_at', Carbon::today())->count();

        // Mengirimkan data ke view
        return view('admin.dashboard', [
            'userCount' => $userCount,
            'todayBookingsCount' => $todayBookingsCount
        ]);
    }
}
