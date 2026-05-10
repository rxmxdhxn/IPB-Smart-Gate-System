@extends('layouts.admin')

@section('title', 'Vehicle Logs')
@section('page-title', 'Vehicle Logs')

@section('content')

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
  /* Custom Select2 styling to match our design */
  .select2-container--default .select2-selection--single {
    height: 38px;
    border: 1px solid rgb(203 213 225);
    border-radius: 0.5rem;
    padding: 0.5rem 0.75rem;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 22px;
    padding-left: 0;
    color: rgb(51 65 85);
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px;
    right: 8px;
  }
  .select2-dropdown {
    border: 1px solid rgb(203 213 225);
    border-radius: 0.5rem;
  }
  .select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: rgb(74 127 229);
  }
  .select2-container--default .select2-search--dropdown .select2-search__field {
    border: 1px solid rgb(203 213 225);
    border-radius: 0.5rem;
    padding: 0.5rem;
  }
  .select2-container {
    width: 100% !important;
  }
</style>

<!-- Filter & Actions -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
  <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
    <div class="flex-1">
      <h2 class="text-lg font-semibold text-slate-800 mb-4">Filter Log</h2>
      <form method="GET" action="{{ route('vehicle-log.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1.5">Tipe</label>
          <select name="type" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">Semua</option>
            <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>Masuk</option>
            <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>Keluar</option>
          </select>
        </div>
        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1.5">Dari Tanggal</label>
          <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1.5">Sampai Tanggal</label>
          <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1.5">Plat Nomor</label>
          <input type="text" name="plate_number" value="{{ request('plate_number') }}" placeholder="Cari plat..." class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="md:col-span-4 flex gap-2">
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Filter
          </button>
          <a href="{{ route('vehicle-log.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-300 transition-colors">
            Reset
          </a>
        </div>
      </form>
    </div>
    <div class="flex gap-2">
      <button onclick="openModal()" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors inline-flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Log Manual
      </button>
      <a href="{{ route('vehicle-log.export', request()->all()) }}" class="px-4 py-2 bg-slate-700 text-white rounded-lg text-sm font-medium hover:bg-slate-800 transition-colors inline-flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        Export Excel
      </a>
    </div>
  </div>
</div>

<!-- Statistics -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
  <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-slate-500 mb-1">Kendaraan Masuk Hari Ini</p>
        <h3 class="text-3xl font-bold text-green-600">{{ $todayIn }}</h3>
      </div>
      <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
        </svg>
      </div>
    </div>
  </div>
  <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-slate-500 mb-1">Kendaraan Keluar Hari Ini</p>
        <h3 class="text-3xl font-bold text-red-600">{{ $todayOut }}</h3>
      </div>
      <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
        </svg>
      </div>
    </div>
  </div>
</div>

<!-- Logs Table -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
  <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
    <h2 class="text-base font-semibold text-slate-800">Daftar Log Aktivitas</h2>
  </div>

  @if(session('success'))
  <div class="mx-6 mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
    <p class="text-sm text-green-800">{{ session('success') }}</p>
  </div>
  @endif

  <div class="overflow-x-auto">
    <table class="w-full">
      <thead class="bg-slate-50 border-b border-slate-200">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Waktu</th>
          <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Plat Nomor</th>
          <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Pengemudi</th>
          <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tipe Kendaraan</th>
          <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
          <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200">
        @forelse($logs as $log)
        <tr class="hover:bg-slate-50 transition-colors">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-slate-900">{{ $log->logged_at->format('H:i:s') }}</div>
            <div class="text-xs text-slate-500">{{ $log->logged_at->format('d M Y') }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-slate-900">{{ $log->plate_number }}</div>
            @if($log->vehicle)
            <div class="text-xs text-slate-500">{{ $log->vehicle->brand }} {{ $log->vehicle->type }}</div>
            @endif
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-slate-700">
              {{ $log->driver_name ?? ($log->vehicle->user->name ?? '-') }}
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-slate-700">
              {{ $log->vehicle->vehicle_type ?? '-' }}
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            @if($log->type === 'in')
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"/>
              </svg>
              Masuk
            </span>
            @else
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" transform="rotate(180 10 10)"/>
              </svg>
              Keluar
            </span>
            @endif
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            <a href="{{ route('vehicle-log.show', $log->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
              Detail
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="px-6 py-12 text-center">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-sm text-slate-500">Belum ada log aktivitas</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  @if($logs->hasPages())
  <div class="px-6 py-4 border-t border-slate-200">
    {{ $logs->links() }}
  </div>
  @endif
</div>

<!-- Modal Tambah Log -->
<div id="addLogModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
  <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
    <!-- Modal Header -->
    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 sticky top-0 bg-white rounded-t-xl">
      <h3 class="text-lg font-semibold text-slate-800">Tambah Log Kendaraan</h3>
      <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Modal Body -->
    <div class="p-6">
      @if($errors->any())
      <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
        <ul class="list-disc list-inside text-sm text-red-800">
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form method="POST" action="{{ route('vehicle-log.store') }}" enctype="multipart/form-data" id="addLogForm">
        @csrf

        <div class="space-y-4">
          <!-- Vehicle Selection -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Kendaraan *</label>
            <select name="vehicle_id" id="vehicle_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="">Cari plat nomor atau pemilik...</option>
              @foreach($vehicles as $vehicle)
              <option value="{{ $vehicle->id }}" 
                      data-plate="{{ $vehicle->plate_number }}" 
                      data-driver="{{ $vehicle->user->name ?? '' }}"
                      data-brand="{{ $vehicle->brand }}"
                      data-type="{{ $vehicle->type }}">
                {{ $vehicle->plate_number }} - {{ $vehicle->brand }} {{ $vehicle->type }} ({{ $vehicle->user->name ?? 'N/A' }})
              </option>
              @endforeach
            </select>
            <p class="text-xs text-slate-500 mt-1">Ketik untuk mencari plat nomor atau nama pemilik</p>
          </div>

          <!-- Type -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Tipe Log *</label>
            <div class="flex gap-4">
              <label class="flex items-center cursor-pointer">
                <input type="radio" name="type" value="in" required class="mr-2 w-4 h-4 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-slate-700">Masuk</span>
              </label>
              <label class="flex items-center cursor-pointer">
                <input type="radio" name="type" value="out" required class="mr-2 w-4 h-4 text-blue-600 focus:ring-blue-500">
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

        <!-- Modal Footer -->
        <div class="flex gap-3 mt-6 pt-4 border-t border-slate-200">
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
            Simpan Log
          </button>
          <button type="button" onclick="closeModal()" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-300 transition-colors">
            Batal
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
// Initialize Select2 for searchable dropdown
$(document).ready(function() {
  $('#vehicle_id').select2({
    placeholder: 'Cari plat nomor atau pemilik...',
    allowClear: true,
    dropdownParent: $('#addLogModal'),
    width: '100%',
    matcher: function(params, data) {
      // If there are no search terms, return all data
      if ($.trim(params.term) === '') {
        return data;
      }

      // Do not display the item if there is no 'text' property
      if (typeof data.text === 'undefined') {
        return null;
      }

      // Search in text (which includes plate number, brand, type, and owner name)
      if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
        return data;
      }

      // Return `null` if the term should not be displayed
      return null;
    }
  });
});

// Modal functions
function openModal() {
  document.getElementById('addLogModal').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
  // Reinitialize Select2 when modal opens
  setTimeout(function() {
    $('#vehicle_id').select2('open');
  }, 100);
}

function closeModal() {
  document.getElementById('addLogModal').classList.add('hidden');
  document.body.style.overflow = 'auto';
  document.getElementById('addLogForm').reset();
  // Destroy and reinitialize Select2
  $('#vehicle_id').val(null).trigger('change');
  document.getElementById('plate_number').value = '';
  document.getElementById('driver_name').value = '';
}

// Close modal when clicking outside
document.getElementById('addLogModal').addEventListener('click', function(e) {
  if (e.target === this) {
    closeModal();
  }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeModal();
  }
});

// Auto-fill plate number and driver name when vehicle is selected
$('#vehicle_id').on('select2:select', function(e) {
  const selectedOption = e.params.data.element;
  const plateNumber = selectedOption.getAttribute('data-plate');
  const driverName = selectedOption.getAttribute('data-driver');
  
  document.getElementById('plate_number').value = plateNumber || '';
  document.getElementById('driver_name').value = driverName || '';
});

// Open modal if there are validation errors
@if($errors->any())
  openModal();
@endif
</script>

@endsection
