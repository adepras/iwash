<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function admin()
    {
        return view('admin.admin-app');
    }

    public function adminprofile()
    {
        return view('admin.admin-profile');
    }

    public function dashboard()
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

    public function users()
    {
        return view('admin.users');
    }

    public function booking()
    {
        return view('admin.booking');
    }

    public function queue()
    {
        return view('admin.queue');
    }

    public function sidebar()
    {
        return view('admin.sidebar');
    }
}
