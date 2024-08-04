<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $sortOrder = $request->get('sortOrder', 'asc');
        $search = $request->input('search');

        $users = User::query()
            ->where('role', '<>', 'admin')
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('phone_number', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('address', 'LIKE', "%{$search}%");
                }
            })
            ->orderBy('name', $sortOrder)
            ->get();

        return view('admin.menu.users', compact('users', 'sortOrder'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui');
    }
}
