<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = Vehicle::with('user')->get();
        
        // Ambil log aktivitas terbaru dengan pagination (10 per halaman)
        $recentLogs = VehicleLog::with('vehicle.user')
            ->orderBy('logged_at', 'desc')
            ->paginate(10);
        
        // Hitung total kendaraan masuk hari ini
        $todayIn = VehicleLog::where('type', 'in')
            ->whereDate('logged_at', Carbon::today())
            ->count();
        
        // Hitung total kendaraan keluar hari ini
        $todayOut = VehicleLog::where('type', 'out')
            ->whereDate('logged_at', Carbon::today())
            ->count();
        
        // Kendaraan yang sedang parkir (masuk tapi belum keluar)
        $currentlyParked = VehicleLog::selectRaw('vehicle_id, MAX(logged_at) as last_log')
            ->groupBy('vehicle_id')
            ->get()
            ->filter(function($log) {
                $lastLog = VehicleLog::where('vehicle_id', $log->vehicle_id)
                    ->where('logged_at', $log->last_log)
                    ->first();
                return $lastLog && $lastLog->type === 'in';
            })
            ->count();

        return view('admin.dashboard', [
            'totalVehicles' => $vehicles->count(),
            'vehicles' => $vehicles,
            'recentLogs' => $recentLogs,
            'todayIn' => $todayIn,
            'todayOut' => $todayOut,
            'currentlyParked' => $currentlyParked,
        ]);
    }

    public function userIndex()
    {
        $allUsers = User::all();
        $users = User::latest()->paginate(10);

        return view('admin.user.index', [
            'allUsers' => $allUsers,
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'nim_nip' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,mahasiswa,tendik,staff',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nim_nip' => $request->nim_nip,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')
            ->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nim_nip' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,mahasiswa,tendik,staff',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'nim_nip' => $request->nim_nip,
            'phone' => $request->phone,
            'role' => $request->role,
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')
            ->with('success', 'Data pengguna berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'Pengguna berhasil dihapus');
    }
}
