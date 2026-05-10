<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleLog;
use App\Exports\VehicleLogsExport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class VehicleLogController extends Controller
{
    /**
     * Display a listing of vehicle logs with filters
     */
    public function index(Request $request)
    {
        $query = VehicleLog::with('vehicle.user')->orderBy('logged_at', 'desc');

        // Filter by type (in/out)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('logged_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('logged_at', '<=', $request->date_to);
        }

        // Filter by plate number
        if ($request->filled('plate_number')) {
            $query->where('plate_number', 'like', '%' . $request->plate_number . '%');
        }

        $logs = $query->paginate(10);

        // Statistics
        $todayIn = VehicleLog::where('type', 'in')
            ->whereDate('logged_at', Carbon::today())
            ->count();
        
        $todayOut = VehicleLog::where('type', 'out')
            ->whereDate('logged_at', Carbon::today())
            ->count();

        // Get all vehicles for modal form
        $vehicles = Vehicle::with('user')->get();

        return view('admin.vehicle-log.index', compact('logs', 'todayIn', 'todayOut', 'vehicles'));
    }

    /**
     * Store a newly created log entry
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'type' => 'required|in:in,out',
            'plate_number' => 'required|string|max:20',
            'driver_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'camera_snapshot' => 'nullable|image|max:2048', // max 2MB
        ]);

        $data = [
            'vehicle_id' => $request->vehicle_id,
            'type' => $request->type,
            'plate_number' => $request->plate_number,
            'driver_name' => $request->driver_name,
            'notes' => $request->notes,
            'logged_at' => now(),
        ];

        // Handle camera snapshot upload
        if ($request->hasFile('camera_snapshot')) {
            $path = $request->file('camera_snapshot')->store('vehicle-snapshots', 'public');
            $data['camera_snapshot'] = $path;
        }

        VehicleLog::create($data);

        return redirect()->route('vehicle-log.index')
            ->with('success', 'Log kendaraan berhasil ditambahkan');
    }

    /**
     * Display the specified log entry
     */
    public function show($id)
    {
        $log = VehicleLog::with('vehicle.user')->findOrFail($id);
        return view('admin.vehicle-log.show', compact('log'));
    }

    /**
     * API endpoint for automatic logging (from camera/sensor system)
     */
    public function apiStore(Request $request)
    {
        $request->validate([
            'plate_number' => 'required|string|max:20',
            'type' => 'required|in:in,out',
            'driver_name' => 'nullable|string|max:255',
            'camera_snapshot' => 'nullable|string', // base64 image or URL
        ]);

        // Find vehicle by plate number
        $vehicle = Vehicle::where('plate_number', $request->plate_number)->first();

        if (!$vehicle) {
            return response()->json([
                'success' => false,
                'message' => 'Kendaraan dengan plat nomor tersebut tidak terdaftar'
            ], 404);
        }

        $data = [
            'vehicle_id' => $vehicle->id,
            'type' => $request->type,
            'plate_number' => $request->plate_number,
            'driver_name' => $request->driver_name ?? $vehicle->user->name,
            'logged_at' => now(),
        ];

        // Handle base64 image if provided
        if ($request->filled('camera_snapshot')) {
            // Save base64 image logic here if needed
            $data['camera_snapshot'] = $request->camera_snapshot;
        }

        $log = VehicleLog::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Log berhasil dicatat',
            'data' => $log
        ], 201);
    }

    /**
     * Export logs to XLSX
     */
    public function export(Request $request)
    {
        $query = VehicleLog::query()->orderBy('logged_at', 'desc');

        // Apply same filters as index
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('logged_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('logged_at', '<=', $request->date_to);
        }
        if ($request->filled('plate_number')) {
            $query->where('plate_number', 'like', '%' . $request->plate_number . '%');
        }

        $filename = 'vehicle-logs-' . date('Y-m-d-His') . '.xlsx';

        return Excel::download(new VehicleLogsExport($query), $filename);
    }

    /**
     * Delete old logs (cleanup)
     */
    public function cleanup(Request $request)
    {
        $days = $request->input('days', 90); // Default 90 days
        
        $deleted = VehicleLog::where('logged_at', '<', Carbon::now()->subDays($days))->delete();

        return redirect()->route('vehicle-log.index')
            ->with('success', "Berhasil menghapus {$deleted} log lama");
    }
}
