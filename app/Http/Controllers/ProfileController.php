<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $vehicles = Vehicle::where('user_id', $user->id)->orderBy('vehicle_brand')->get();
        return view('profile.profile', compact('user', 'vehicles'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:15',
            'gender' => 'required|string|in:male,female',
            'address' => 'required|string|max:255',
        ]);

        // Update user data
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone_number = $validatedData['phone_number'];
        $user->gender = $validatedData['gender'];
        $user->address = $validatedData['address'];
        $user->save();

        // Redirect back to the profile page with a success message
        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui');
    }



    public function edit_profile(Request $request)
    {
        $user = Auth::user();
        return view('profile.edit_profile', compact('user'));
        
    }
}
