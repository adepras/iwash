<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil semua data user
        $users = User::all();

        // Mengirim data ke view
        return view('admin.users.index', compact('users'));
    }
}
