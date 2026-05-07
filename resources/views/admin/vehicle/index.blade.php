@extends('layouts.admin')

@section('title', 'Kendaraan')
@section('page-title', 'Kendaraan')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
  <div>
    <h1 class="text-xl font-bold text-[#0f2854]">Kendaraan</h1>
    <p class="text-sm text-slate-500 mt-1">Kelola semua data kendaraan</p>
  </div>
  <button onclick="openCreateModal()"
     class="inline-flex items-center gap-2 bg-[#4a7fe5] hover:bg-[#3a6fd5] text-white text-sm font-semibold px-5 py-2.5 rounded-[10px] transition-colors shadow-md shadow-[#4a7fe5]/20">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
      <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
    </svg>
    Tambah Kendaraan
  </button>
</div>

{{-- Success Message --}}
@if(session('success'))
<div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-sm text-emerald-700">
  {{ session('success') }}
</div>
@endif

{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-4 gap-5 mb-8">
  <div class="bg-white rounded-[14px] p-5 shadow-sm border border-slate-100">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
        <svg class="w-5 h-5 stroke-[#4a7fe5]" viewBox="0 0 24 24" fill="none" stroke-width="2">
          <rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4l3 5v3h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
        </svg>
      </div>
      <div>
        <p class="text-[22px] font-bold text-[#0f2854] leading-none">{{ $allVehicles->count() }}</p>
        <p class="text-[12.5px] text-slate-500 mt-1">Total Kendaraan</p>
      </div>
    </div>
  </div>
  <div class="bg-white rounded-[14px] p-5 shadow-sm border border-slate-100">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center">
        <svg class="w-5 h-5 stroke-purple-500" viewBox="0 0 24 24" fill="none" stroke-width="2">
          <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
        </svg>
      </div>
      <div>
        <p class="text-[22px] font-bold text-purple-500 leading-none">{{ $allVehicles->filter(fn($v) => $v->user && $v->user->role === 'tendik')->count() }}</p>
        <p class="text-[12.5px] text-slate-500 mt-1">Tendik</p>
      </div>
    </div>
  </div>
  <div class="bg-white rounded-[14px] p-5 shadow-sm border border-slate-100">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
        <svg class="w-5 h-5 stroke-amber-500" viewBox="0 0 24 24" fill="none" stroke-width="2">
          <rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>
        </svg>
      </div>
      <div>
        <p class="text-[22px] font-bold text-amber-500 leading-none">{{ $allVehicles->filter(fn($v) => $v->user && $v->user->role === 'staff')->count() }}</p>
        <p class="text-[12.5px] text-slate-500 mt-1">Staff</p>
      </div>
    </div>
  </div>
  <div class="bg-white rounded-[14px] p-5 shadow-sm border border-slate-100">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
        <svg class="w-5 h-5 stroke-emerald-500" viewBox="0 0 24 24" fill="none" stroke-width="2">
          <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 3 3 6 3s6-1 6-3v-5"/>
        </svg>
      </div>
      <div>
        <p class="text-[22px] font-bold text-emerald-500 leading-none">{{ $allVehicles->filter(fn($v) => $v->user && $v->user->role === 'mahasiswa')->count() }}</p>
        <p class="text-[12.5px] text-slate-500 mt-1">Mahasiswa</p>
      </div>
    </div>
  </div>
</div>

{{-- Table --}}
<div class="bg-white rounded-[14px] shadow-sm border border-slate-100 overflow-hidden">
  <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
    <div>
      <h2 class="text-[15px] font-bold text-[#0f2854]">Daftar Kendaraan</h2>
      <p class="text-xs text-slate-400 mt-0.5">{{ $vehicles->total() }} kendaraan terdaftar</p>
    </div>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full">
      <thead>
        <tr class="border-b border-slate-100">
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Plat Nomor</th>
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Pemilik</th>
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Jenis</th>
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Merk</th>
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Tipe</th>
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Warna</th>
          <th class="text-center text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($vehicles as $vehicle)
        <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
          <td class="px-6 py-3.5">
            <span class="text-[13px] font-bold text-[#0f2854] tracking-wide">{{ $vehicle->plate_number }}</span>
          </td>
          <td class="px-6 py-3.5">
            <div class="flex items-center gap-2.5">
              <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#4a7fe5] to-blue-600 flex items-center justify-center text-[10px] font-bold text-white flex-shrink-0">
                {{ strtoupper(substr($vehicle->user->name ?? '?', 0, 2)) }}
              </div>
              <div>
                <span class="text-[12px] font-semibold text-slate-700 block">{{ $vehicle->user->name ?? '—' }}</span>
                <span class="text-[10px] text-slate-400">{{ $vehicle->user->nim_nip ?? '' }}</span>
              </div>
            </div>
          </td>
          <td class="px-6 py-3.5">
            <span class="text-[12px] text-slate-600">{{ ucfirst($vehicle->vehicle_type) }}</span>
          </td>
          <td class="px-6 py-3.5">
            <span class="text-[12px] text-slate-600">{{ $vehicle->brand ?? '—' }}</span>
          </td>
          <td class="px-6 py-3.5">
            <span class="text-[12px] text-slate-500 font-mono">{{ $vehicle->type ?? '—' }}</span>
          </td>
          <td class="px-6 py-3.5">
            <span class="text-[12px] text-slate-600">{{ $vehicle->color ?? '—' }}</span>
          </td>
          
          <td class="px-6 py-3.5">
            <div class="flex items-center justify-center gap-2">
              <button onclick="openEditModal({{ json_encode($vehicle) }})"
                 class="text-[11px] font-semibold text-[#0f2854] bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg transition-colors">
                Edit
              </button>
              <button onclick="openDeleteModal('{{ $vehicle->id }}', '{{ $vehicle->plate_number }}')"
                      class="text-[11px] font-semibold text-red-500 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors">
                Hapus
              </button>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="text-center py-12 text-slate-400 text-sm">
            <svg class="w-10 h-10 mx-auto mb-3 stroke-slate-300" viewBox="0 0 24 24" fill="none" stroke-width="1.5">
              <rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4l3 5v3h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
            </svg>
            Belum ada kendaraan terdaftar.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Pagination --}}
  @if($vehicles->hasPages())
  <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between">
    <p class="text-[12px] text-slate-400">
      Menampilkan {{ $vehicles->firstItem() }}–{{ $vehicles->lastItem() }} dari {{ $vehicles->total() }} data
    </p>
    <div class="flex items-center gap-1">
      @if($vehicles->onFirstPage())
        <span class="px-3 py-1.5 text-[12px] text-slate-300 bg-slate-50 rounded-lg cursor-not-allowed">&laquo; Prev</span>
      @else
        <a href="{{ $vehicles->previousPageUrl() }}" class="px-3 py-1.5 text-[12px] font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors no-underline">&laquo; Prev</a>
      @endif

      @foreach($vehicles->getUrlRange(1, $vehicles->lastPage()) as $page => $url)
        @if($page == $vehicles->currentPage())
          <span class="px-3 py-1.5 text-[12px] font-semibold text-white bg-[#4a7fe5] rounded-lg">{{ $page }}</span>
        @else
          <a href="{{ $url }}" class="px-3 py-1.5 text-[12px] font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors no-underline">{{ $page }}</a>
        @endif
      @endforeach

      @if($vehicles->hasMorePages())
        <a href="{{ $vehicles->nextPageUrl() }}" class="px-3 py-1.5 text-[12px] font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors no-underline">Next &raquo;</a>
      @else
        <span class="px-3 py-1.5 text-[12px] text-slate-300 bg-slate-50 rounded-lg cursor-not-allowed">Next &raquo;</span>
      @endif
    </div>
  </div>
  @endif
</div>

{{-- CREATE MODAL --}}
<div id="createModal" class="fixed inset-0 z-50 hidden items-center justify-center">
  <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeCreateModal()"></div>
  <div class="relative bg-white rounded-2xl shadow-xl p-8 w-full max-w-xl mx-4">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h3 class="text-lg font-bold text-[#0f2854]">Tambah Kendaraan</h3>
        <p class="text-xs text-slate-400 mt-0.5">Sesuaikan data dengan STNK asli.</p>
      </div>
      <button onclick="closeCreateModal()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
        <svg class="w-4 h-4 stroke-slate-500" viewBox="0 0 24 24" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>

    <form id="createForm" method="POST" action="{{ route('vehicle.store') }}" onsubmit="return validateCreateForm()">
      @csrf
      {{-- Row 1: Pemilik (full width) --}}
      <div class="mb-4">
        <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Pemilik <span class="text-red-400">*</span></label>
        <div class="relative" id="createOwnerDropdown">
          <input type="hidden" name="user_id" id="create_user_id">
          <input type="text" id="create_owner_search" placeholder="Cari nama pemilik..." autocomplete="off"
                 onclick="toggleDropdown('create')" oninput="filterUsers('create')"
                 class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
          <div id="create_owner_list" class="absolute z-10 mt-1 w-full bg-white border border-slate-200 rounded-lg shadow-lg max-h-48 overflow-y-auto hidden">
            @foreach($users as $user)
            <div class="owner-option px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 cursor-pointer"
                 data-id="{{ $user->id }}" data-name="{{ $user->name }} ({{ ucfirst($user->role) }} - {{ $user->nim_nip ?? 'No NIM/NIP' }})"
                 onclick="selectUser('create', '{{ $user->id }}', '{{ $user->name }} ({{ ucfirst($user->role) }} - {{ $user->nim_nip ?? "No NIM/NIP" }})')">
              {{ $user->name }} <span class="text-slate-400">({{ ucfirst($user->role) }} - {{ $user->nim_nip ?? 'No NIM/NIP' }})</span>
            </div>
            @endforeach
          </div>
        </div>
        <p class="text-[11px] text-red-500 mt-1 hidden" id="err_create_user_id">Harus isi kolom ini</p>
      </div>

      {{-- Row 2: Plat Nomor + Jenis --}}
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Plat Nomor <span class="text-red-400">*</span></label>
          <input type="text" name="plate_number" id="create_plate_number" placeholder="B 1234 XYZ" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
          <p class="text-[11px] text-red-500 mt-1 hidden" id="err_create_plate_number">Harus isi kolom ini</p>
        </div>
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Jenis Kendaraan <span class="text-red-400">*</span></label>
          <select name="vehicle_type" id="create_vehicle_type" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
            <option value="sepeda motor">Sepeda Motor</option>
            <option value="mobil">Mobil</option>
          </select>
        </div>
      </div>

      {{-- Row 3: Brand + Tipe --}}
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Brand <span class="text-red-400">*</span></label>
          <input type="text" name="brand" id="create_brand" placeholder="Honda, Toyota" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
          <p class="text-[11px] text-red-500 mt-1 hidden" id="err_create_brand">Harus isi kolom ini</p>
        </div>
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Tipe <span class="text-red-400">*</span></label>
          <input type="text" name="type" id="create_type" placeholder="X1H02N35M1" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
          <p class="text-[11px] text-red-500 mt-1 hidden" id="err_create_type">Harus isi kolom ini</p>
        </div>
      </div>

      {{-- Row 4: Warna (full width) --}}
      <div class="mb-6">
        <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Warna <span class="text-red-400">*</span></label>
        <input type="text" name="color" id="create_color" placeholder="Hitam, Putih" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
        <p class="text-[11px] text-red-500 mt-1 hidden" id="err_create_color">Harus isi kolom ini</p>
      </div>

      {{-- Buttons --}}
      <div class="flex items-center gap-3">
        <button type="submit" class="px-5 py-2.5 bg-[#4a7fe5] hover:bg-[#3a6fd5] text-white text-sm font-semibold rounded-[10px] transition-colors shadow-md shadow-[#4a7fe5]/20">
          Simpan
        </button>
        <button type="button" onclick="closeCreateModal()" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-semibold rounded-[10px] transition-colors">
          Batal
        </button>
      </div>
    </form>
  </div>
</div>

{{-- EDIT MODAL --}}
<div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center">
  <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeEditModal()"></div>
  <div class="relative bg-white rounded-2xl shadow-xl p-8 w-full max-w-xl mx-4">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h3 class="text-lg font-bold text-[#0f2854]">Edit Kendaraan</h3>
        <p class="text-xs text-slate-400 mt-0.5">Sesuaikan data dengan STNK asli.</p>
      </div>
      <button onclick="closeEditModal()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
        <svg class="w-4 h-4 stroke-slate-500" viewBox="0 0 24 24" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>

    <form id="editForm" method="POST">
      @csrf
      @method('PUT')

      {{-- Row 1: Pemilik (full width) --}}
      <div class="mb-4">
        <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Pemilik</label>
        <div class="relative" id="editOwnerDropdown">
          <input type="hidden" name="user_id" id="edit_user_id">
          <input type="text" id="edit_owner_search" placeholder="Cari nama pemilik..." autocomplete="off"
                 onclick="toggleDropdown('edit')" oninput="filterUsers('edit')"
                 class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
          <div id="edit_owner_list" class="absolute z-10 mt-1 w-full bg-white border border-slate-200 rounded-lg shadow-lg max-h-48 overflow-y-auto hidden">
            @foreach($users as $user)
            <div class="owner-option px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 cursor-pointer"
                 data-id="{{ $user->id }}" data-name="{{ $user->name }} ({{ ucfirst($user->role) }} - {{ $user->nim_nip ?? 'No NIM/NIP' }})"
                 onclick="selectUser('edit', '{{ $user->id }}', '{{ $user->name }} ({{ ucfirst($user->role) }} - {{ $user->nim_nip ?? "No NIM/NIP" }})')">
              {{ $user->name }} <span class="text-slate-400">({{ ucfirst($user->role) }} - {{ $user->nim_nip ?? 'No NIM/NIP' }})</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- Row 2: Plat Nomor + Jenis --}}
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Plat Nomor</label>
          <input type="text" name="plate_number" id="edit_plate_number" placeholder="B 1234 XYZ" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
        </div>
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Jenis Kendaraan</label>
          <select name="vehicle_type" id="edit_vehicle_type" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
            <option value="sepeda motor">Sepeda Motor</option>
            <option value="mobil">Mobil</option>
          </select>
        </div>
      </div>

      {{-- Row 3: Brand + Tipe --}}
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Brand</label>
          <input type="text" name="brand" id="edit_brand" placeholder="Honda, Toyota" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
        </div>
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Tipe</label>
          <input type="text" name="type" id="edit_type" placeholder="X1H02N35M1" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
        </div>
      </div>

      {{-- Row 4: Warna (full width) --}}
      <div class="mb-6">
        <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Warna</label>
        <input type="text" name="color" id="edit_color" placeholder="Hitam, Putih" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
      </div>

      {{-- Buttons --}}
      <div class="flex items-center gap-3">
        <button type="submit" class="px-5 py-2.5 bg-[#4a7fe5] hover:bg-[#3a6fd5] text-white text-sm font-semibold rounded-[10px] transition-colors shadow-md shadow-[#4a7fe5]/20">
          Update
        </button>
        <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-semibold rounded-[10px] transition-colors">
          Batal
        </button>
      </div>
    </form>
  </div>
</div>

{{-- DELETE MODAL --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center">
  <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
  <div class="relative bg-white rounded-2xl shadow-xl p-6 w-full max-w-sm mx-4">
    <div class="flex flex-col items-center text-center">
      <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mb-4">
        <svg class="w-6 h-6 stroke-red-500" viewBox="0 0 24 24" fill="none" stroke-width="2">
          <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
          <line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/>
        </svg>
      </div>
      <h3 class="text-lg font-bold text-slate-800 mb-1">Hapus Kendaraan</h3>
      <p class="text-sm text-slate-500 mb-6">Apakah Anda yakin ingin menghapus kendaraan <strong id="deleteVehicleName" class="text-slate-700"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
      <div class="flex items-center gap-3 w-full">
        <button onclick="closeDeleteModal()"
                class="flex-1 px-4 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-[10px] transition-colors">
          Batal
        </button>
        <form id="deleteForm" method="POST" class="flex-1">
          @csrf @method('DELETE')
          <button type="submit"
                  class="w-full px-4 py-2.5 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-[10px] transition-colors">
            Hapus
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // FORM VALIDATION
  function validateCreateForm() {
    const fields = [
      { id: 'create_user_id', errId: 'err_create_user_id' },
      { id: 'create_plate_number', errId: 'err_create_plate_number' },
      { id: 'create_brand', errId: 'err_create_brand' },
      { id: 'create_type', errId: 'err_create_type' },
      { id: 'create_color', errId: 'err_create_color' },
    ];

    let valid = true;

    fields.forEach(field => {
      const input = document.getElementById(field.id);
      const err = document.getElementById(field.errId);
      if (!input.value.trim()) {
        err.classList.remove('hidden');
        input.classList.add('border-red-300');
        valid = false;
      } else {
        err.classList.add('hidden');
        input.classList.remove('border-red-300');
      }
    });

    return valid;
  }

  // SEARCHABLE DROPDOWN
  function toggleDropdown(prefix) {
    const list = document.getElementById(prefix + '_owner_list');
    list.classList.toggle('hidden');
  }

  function filterUsers(prefix) {
    const input = document.getElementById(prefix + '_owner_search');
    const list = document.getElementById(prefix + '_owner_list');
    const items = list.querySelectorAll('.owner-option');
    const query = input.value.toLowerCase();

    list.classList.remove('hidden');
    items.forEach(item => {
      const name = item.getAttribute('data-name').toLowerCase();
      item.style.display = name.includes(query) ? '' : 'none';
    });
  }

  function selectUser(prefix, id, name) {
    document.getElementById(prefix + '_user_id').value = id;
    document.getElementById(prefix + '_owner_search').value = name;
    document.getElementById(prefix + '_owner_list').classList.add('hidden');
  }

  // Close dropdown when clicking outside
  document.addEventListener('click', function(e) {
    ['create', 'edit'].forEach(prefix => {
      const dropdown = document.getElementById(prefix + 'OwnerDropdown');
      if (dropdown && !dropdown.contains(e.target)) {
        document.getElementById(prefix + '_owner_list').classList.add('hidden');
      }
    });
  });

  // CREATE MODAL
  function openCreateModal() {
    document.getElementById('create_user_id').value = '';
    document.getElementById('create_owner_search').value = '';
    document.getElementById('createModal').classList.remove('hidden');
    document.getElementById('createModal').classList.add('flex');
  }
  function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
    document.getElementById('createModal').classList.remove('flex');
  }

  // EDIT MODAL
  function openEditModal(vehicle) {
    document.getElementById('editForm').action = '/vehicle/' + vehicle.id;
    document.getElementById('edit_user_id').value = vehicle.user_id;
    // Set owner search input with user name
    const editOptions = document.querySelectorAll('#edit_owner_list .owner-option');
    editOptions.forEach(opt => {
      if (opt.getAttribute('data-id') == vehicle.user_id) {
        document.getElementById('edit_owner_search').value = opt.getAttribute('data-name');
      }
    });
    document.getElementById('edit_plate_number').value = vehicle.plate_number;
    document.getElementById('edit_vehicle_type').value = vehicle.vehicle_type;
    document.getElementById('edit_brand').value = vehicle.brand || '';
    document.getElementById('edit_type').value = vehicle.type || '';
    document.getElementById('edit_color').value = vehicle.color || '';
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
  }
  function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
  }

  // DELETE MODAL
  function openDeleteModal(id, name) {
    document.getElementById('deleteVehicleName').textContent = name;
    document.getElementById('deleteForm').action = '/vehicle/' + id;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
  }
  function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
  }
</script>

@endsection
