<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $todayBookingsCount = Booking::whereDate('created_at', Carbon::today())->count();
        
        dd(compact('userCount', 'todayBookingsCount')); // Tambahkan ini untuk debugging

        return view('admin.dashboard', compact('userCount', 'todayBookingsCount'));
    }
}
