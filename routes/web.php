<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleLogController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Panel Routes
Route::middleware(['auth'])->group(function () {

    // User Management Routes
    Route::get('/user', [AdminController::class, 'userIndex'])->name('user.index');
    Route::post('/user', [AdminController::class, 'store'])->name('user.store');
    Route::put('/user/{id}', [AdminController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [AdminController::class, 'destroy'])->name('user.destroy');

    // Vehicle Management Routes
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicle.index');
    Route::post('/vehicle', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::put('/vehicle/{id}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::delete('/vehicle/{id}', [VehicleController::class, 'destroy'])->name('vehicle.destroy');

    // Vehicle Log Routes
    Route::get('/vehicle-logs', [VehicleLogController::class, 'index'])->name('vehicle-log.index');
    Route::get('/vehicle-logs/export', [VehicleLogController::class, 'export'])->name('vehicle-log.export');
    Route::post('/vehicle-logs', [VehicleLogController::class, 'store'])->name('vehicle-log.store');
    Route::post('/vehicle-logs/cleanup', [VehicleLogController::class, 'cleanup'])->name('vehicle-log.cleanup');
    Route::post('/vehicle-logs/store-detection', [VehicleLogController::class, 'storeDetection'])->name('vehicle-log.store-detection');
    Route::get('/vehicle-logs/{id}', [VehicleLogController::class, 'show'])->name('vehicle-log.show');
});

// API Routes for Camera/Sensor Integration
Route::post('/api/vehicle-log', [VehicleLogController::class, 'apiStore'])->name('api.vehicle-log.store');






require __DIR__.'/auth.php';
