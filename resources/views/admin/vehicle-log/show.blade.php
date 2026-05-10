@extends('layouts.admin')

@section('title', 'Detail Log')
@section('page-title', 'Detail Log Kendaraan')

@section('content')

<div class="max-w-4xl">
  <div class="mb-4">
    <a href="{{ route('vehicle-log.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium inline-flex items-center gap-1">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      Kembali ke Daftar Log
    </a>
  </div>

  <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
      <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-800">Detail Log #{{ $log->id }}</h2>
        @if($log->type === 'in')
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-700">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"/>
          </svg>
          Kendaraan Masuk
        </span>
        @else
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-700">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" transform="rotate(180 10 10)"/>
          </svg>
          Kendaraan Keluar
        </span>
        @endif
      </div>
    </div>

    <div class="p-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Left Column -->
        <div class="space-y-4">
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Waktu</label>
            <p class="text-base font-medium text-slate-900">{{ $log->logged_at->format('d F Y, H:i:s') }}</p>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Plat Nomor</label>
            <p class="text-base font-medium text-slate-900">{{ $log->plate_number }}</p>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Pengemudi</label>
            <p class="text-base font-medium text-slate-900">{{ $log->driver_name ?? ($log->vehicle->user->name ?? '-') }}</p>
          </div>

          @if($log->vehicle)
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Informasi Kendaraan</label>
            <div class="bg-slate-50 rounded-lg p-4 space-y-2">
              <div class="flex justify-between">
                <span class="text-sm text-slate-600">Tipe:</span>
                <span class="text-sm font-medium text-slate-900">{{ $log->vehicle->vehicle_type }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-sm text-slate-600">Merek:</span>
                <span class="text-sm font-medium text-slate-900">{{ $log->vehicle->brand }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-sm text-slate-600">Model:</span>
                <span class="text-sm font-medium text-slate-900">{{ $log->vehicle->type }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-sm text-slate-600">Warna:</span>
                <span class="text-sm font-medium text-slate-900">{{ $log->vehicle->color }}</span>
              </div>
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Pemilik Kendaraan</label>
            <div class="bg-slate-50 rounded-lg p-4 space-y-2">
              <div class="flex justify-between">
                <span class="text-sm text-slate-600">Nama:</span>
                <span class="text-sm font-medium text-slate-900">{{ $log->vehicle->user->name ?? '-' }}</span>
              </div>
              @if($log->vehicle->user->nim_nip)
              <div class="flex justify-between">
                <span class="text-sm text-slate-600">NIM/NIP:</span>
                <span class="text-sm font-medium text-slate-900">{{ $log->vehicle->user->nim_nip }}</span>
              </div>
              @endif
              @if($log->vehicle->user->role)
              <div class="flex justify-between">
                <span class="text-sm text-slate-600">Role:</span>
                <span class="text-sm font-medium text-slate-900 capitalize">{{ $log->vehicle->user->role }}</span>
              </div>
              @endif
              <div class="flex justify-between">
                <span class="text-sm text-slate-600">Email:</span>
                <span class="text-sm font-medium text-slate-900">{{ $log->vehicle->user->email ?? '-' }}</span>
              </div>
              @if($log->vehicle->user->phone)
              <div class="flex justify-between">
                <span class="text-sm text-slate-600">Telepon:</span>
                <span class="text-sm font-medium text-slate-900">{{ $log->vehicle->user->phone }}</span>
              </div>
              @endif
            </div>
          </div>
          @endif
        </div>

        <!-- Right Column -->
        <div class="space-y-4">
          @if($log->camera_snapshot)
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Foto Kendaraan</label>
            <div class="rounded-lg overflow-hidden border border-slate-200">
              <img src="{{ asset('storage/' . $log->camera_snapshot) }}" alt="Vehicle Snapshot" class="w-full h-auto">
            </div>
          </div>
          @else
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Foto Kendaraan</label>
            <div class="bg-slate-100 rounded-lg p-8 text-center">
              <svg class="w-16 h-16 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
              <p class="text-sm text-slate-500">Tidak ada foto</p>
            </div>
          </div>
          @endif

          @if($log->notes)
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Catatan</label>
            <div class="bg-slate-50 rounded-lg p-4">
              <p class="text-sm text-slate-700">{{ $log->notes }}</p>
            </div>
          </div>
          @endif

          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Metadata</label>
            <div class="bg-slate-50 rounded-lg p-4 space-y-2">
              <div class="flex justify-between">
                <span class="text-xs text-slate-600">Log ID:</span>
                <span class="text-xs font-medium text-slate-900">#{{ $log->id }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-xs text-slate-600">Dibuat:</span>
                <span class="text-xs font-medium text-slate-900">{{ $log->created_at->format('d M Y, H:i') }}</span>
              </div>
              @if($log->updated_at != $log->created_at)
              <div class="flex justify-between">
                <span class="text-xs text-slate-600">Diupdate:</span>
                <span class="text-xs font-medium text-slate-900">{{ $log->updated_at->format('d M Y, H:i') }}</span>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
