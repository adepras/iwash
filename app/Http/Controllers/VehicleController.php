<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_brand' => 'required|string|max:100',
            'vehicle_type' => 'required|string|max:100',
            'license_plate' => 'required|string|max:20',
        ]);

        Vehicle::create([
            'user_id' => auth()->id(),
            'vehicle_brand' => $request->vehicle_brand,
            'vehicle_type' => $request->vehicle_type,
            'license_plate' => $request->license_plate,
        ]);

        return redirect()->back()->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    public function index()
    {
        $vehicles = Vehicle::where('user_id', auth()->id())->orderBy('vehicle_brand')->get();
        return view('profile', compact('vehicles'));
    }

    public function adminIndex(Request $request)
    {
        $sortOrder = $request->get('sortOrder', 'asc');
        $sortBy = $request->get('sortBy', 'vehicle_brand');

        $allowedSortColumns = ['vehicle_brand', 'vehicle_type', 'license_plate'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'vehicle_brand';
        }

        $vehicles = Vehicle::orderBy($sortBy, $sortOrder)->get();

        return view('admin.menu.vehicles', compact('vehicles', 'sortOrder', 'sortBy'));
    }


    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->back()->with('success', 'Data kendaraan berhasil dihapus.');
    }

    public function checkActiveBooking($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $active = $vehicle->hasActiveBooking();
        return response()->json(['active' => $active]);
    }
}
