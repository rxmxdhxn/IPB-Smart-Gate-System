@extends('layouts.admin')

@section('title', 'Tambah Log Manual')
@section('page-title', 'Tambah Log Manual')

@section('content')

<div class="max-w-2xl">
  <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <h2 class="text-lg font-semibold text-slate-800 mb-6">Form Tambah Log Kendaraan</h2>

    @if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
      <ul class="list-disc list-inside text-sm text-red-800">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('vehicle-log.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="space-y-4">
        <!-- Vehicle Selection -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">Kendaraan *</label>
          <select name="vehicle_id" id="vehicle_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">Pilih Kendaraan</option>
            @foreach($vehicles as $vehicle)
            <option value="{{ $vehicle->id }}" data-plate="{{ $vehicle->plate_number }}" data-driver="{{ $vehicle->user->name ?? '' }}">
              {{ $vehicle->plate_number }} - {{ $vehicle->brand }} {{ $vehicle->type }} ({{ $vehicle->user->name ?? 'N/A' }})
            </option>
            @endforeach
          </select>
        </div>

        <!-- Type -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">Tipe Log *</label>
          <div class="flex gap-4">
            <label class="flex items-center">
              <input type="radio" name="type" value="in" required class="mr-2">
              <span class="text-sm text-slate-700">Masuk</span>
            </label>
            <label class="flex items-center">
              <input type="radio" name="type" value="out" required class="mr-2">
              <span class="text-sm text-slate-700">Keluar</span>
            </label>
          </div>
        </div>

        <!-- Plate Number (auto-filled) -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">Plat Nomor *</label>
          <input type="text" name="plate_number" id="plate_number" required readonly class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm bg-slate-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Driver Name (auto-filled, editable) -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">Nama Pengemudi</label>
          <input type="text" name="driver_name" id="driver_name" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <p class="text-xs text-slate-500 mt-1">Kosongkan jika sama dengan pemilik kendaraan</p>
        </div>

        <!-- Camera Snapshot -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">Foto Kendaraan (Opsional)</label>
          <input type="file" name="camera_snapshot" accept="image/*" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG. Maksimal 2MB</p>
        </div>

        <!-- Notes -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">Catatan</label>
          <textarea name="notes" rows="3" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Catatan tambahan..."></textarea>
        </div>
      </div>

      <div class="flex gap-3 mt-6">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
          Simpan Log
        </button>
        <a href="{{ route('vehicle-log.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-300 transition-colors">
          Batal
        </a>
      </div>
    </form>
  </div>
</div>

<script>
// Auto-fill plate number and driver name when vehicle is selected
document.getElementById('vehicle_id').addEventListener('change', function() {
  const selectedOption = this.options[this.selectedIndex];
  const plateNumber = selectedOption.getAttribute('data-plate');
  const driverName = selectedOption.getAttribute('data-driver');
  
  document.getElementById('plate_number').value = plateNumber || '';
  document.getElementById('driver_name').value = driverName || '';
});
</script>

@endsection
