<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;


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
});






require __DIR__.'/auth.php';
