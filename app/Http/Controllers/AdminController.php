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
        return view('admin.layouts.admin-app');
    }

    public function adminprofile()
    {
        return view('admin.profile.admin-profile');
    }
}
