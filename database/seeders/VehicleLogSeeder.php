<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleLog;
use App\Models\Vehicle;
use Carbon\Carbon;

class VehicleLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua kendaraan
        $vehicles = Vehicle::all();

        if ($vehicles->isEmpty()) {
            $this->command->warn('Tidak ada kendaraan yang terdaftar. Silakan tambahkan kendaraan terlebih dahulu.');
            return;
        }

        $this->command->info('Membuat sample log untuk ' . $vehicles->count() . ' kendaraan...');

        // Buat log untuk hari ini
        foreach ($vehicles as $vehicle) {
            // Log masuk pagi
            VehicleLog::create([
                'vehicle_id' => $vehicle->id,
                'type' => 'in',
                'plate_number' => $vehicle->plate_number,
                'driver_name' => $vehicle->user->name ?? null,
                'logged_at' => Carbon::today()->setTime(8, rand(0, 59), rand(0, 59)),
                'notes' => 'Masuk pagi',
            ]);

            // Log keluar siang (50% chance)
            if (rand(0, 1)) {
                VehicleLog::create([
                    'vehicle_id' => $vehicle->id,
                    'type' => 'out',
                    'plate_number' => $vehicle->plate_number,
                    'driver_name' => $vehicle->user->name ?? null,
                    'logged_at' => Carbon::today()->setTime(12, rand(0, 59), rand(0, 59)),
                    'notes' => 'Keluar istirahat',
                ]);

                // Log masuk lagi sore
                VehicleLog::create([
                    'vehicle_id' => $vehicle->id,
                    'type' => 'in',
                    'plate_number' => $vehicle->plate_number,
                    'driver_name' => $vehicle->user->name ?? null,
                    'logged_at' => Carbon::today()->setTime(13, rand(0, 59), rand(0, 59)),
                    'notes' => 'Kembali setelah istirahat',
                ]);
            }

            // Log keluar sore
            VehicleLog::create([
                'vehicle_id' => $vehicle->id,
                'type' => 'out',
                'plate_number' => $vehicle->plate_number,
                'driver_name' => $vehicle->user->name ?? null,
                'logged_at' => Carbon::today()->setTime(17, rand(0, 59), rand(0, 59)),
                'notes' => 'Pulang',
            ]);
        }

        // Buat log untuk kemarin
        foreach ($vehicles->take(3) as $vehicle) {
            VehicleLog::create([
                'vehicle_id' => $vehicle->id,
                'type' => 'in',
                'plate_number' => $vehicle->plate_number,
                'driver_name' => $vehicle->user->name ?? null,
                'logged_at' => Carbon::yesterday()->setTime(8, rand(0, 59), rand(0, 59)),
            ]);

            VehicleLog::create([
                'vehicle_id' => $vehicle->id,
                'type' => 'out',
                'plate_number' => $vehicle->plate_number,
                'driver_name' => $vehicle->user->name ?? null,
                'logged_at' => Carbon::yesterday()->setTime(17, rand(0, 59), rand(0, 59)),
            ]);
        }

        $totalLogs = VehicleLog::count();
        $this->command->info("Berhasil membuat {$totalLogs} log kendaraan!");
    }
}
