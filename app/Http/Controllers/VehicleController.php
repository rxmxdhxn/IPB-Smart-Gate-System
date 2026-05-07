<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $allVehicles = Vehicle::with('user')->get();
        $vehicles = Vehicle::with('user')->latest()->paginate(10);
        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.vehicle.index', compact('allVehicles', 'vehicles', 'users'));
    }

    public function create()
    {
        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.vehicle.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plate_number' => 'required|unique:vehicles,plate_number',
            'vehicle_type' => 'required|in:sepeda motor,mobil',
            'brand' => 'nullable|string|max:100',
            'type' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:50',
        ]);

        Vehicle::create([
            'user_id' => $request->user_id,
            'plate_number' => strtoupper($request->plate_number),
            'vehicle_type' => $request->vehicle_type,
            'brand' => $request->brand,
            'type' => $request->type,
            'color' => $request->color,
            'status' => 'pending',
        ]);

        return redirect()->route('vehicle.index')
            ->with('success', 'Kendaraan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::with('user')->findOrFail($id);
        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.vehicle.edit', compact('vehicle', 'users'));
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plate_number' => 'required|unique:vehicles,plate_number,' . $vehicle->id,
            'vehicle_type' => 'required|in:sepeda motor,mobil',
            'brand' => 'nullable|string|max:100',
            'type' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:50',
        ]);

        $vehicle->update([
            'user_id' => $request->user_id,
            'plate_number' => strtoupper($request->plate_number),
            'vehicle_type' => $request->vehicle_type,
            'brand' => $request->brand,
            'type' => $request->type,
            'color' => $request->color,
        ]);

        return redirect()->route('vehicle.index')
            ->with('success', 'Data kendaraan berhasil diupdate');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('vehicle.index')
            ->with('success', 'Data kendaraan berhasil dihapus');
    }
}
