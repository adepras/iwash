<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('admin.dashboard');
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
}
