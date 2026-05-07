@extends('layouts.admin')

@section('title', 'User')
@section('page-title', 'User')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
  <div>
    <h1 class="text-xl font-bold text-[#0f2854]">Pengguna</h1>
    <p class="text-sm text-slate-500 mt-1">Kelola semua data pengguna sistem</p>
  </div>
  <button onclick="openCreateModal()"
     class="inline-flex items-center gap-2 bg-[#4a7fe5] hover:bg-[#3a6fd5] text-white text-sm font-semibold px-5 py-2.5 rounded-[10px] transition-colors shadow-md shadow-[#4a7fe5]/20">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
      <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
    </svg>
    Tambah Pengguna
  </button>
</div>

{{-- Success Message --}}
@if(session('success'))
<div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-sm text-emerald-700">
  {{ session('success') }}
</div>
@endif

{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
  <div class="bg-white rounded-[14px] p-5 shadow-sm border border-slate-100">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
        <svg class="w-5 h-5 stroke-[#4a7fe5]" viewBox="0 0 24 24" fill="none" stroke-width="2">
          <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
        </svg>
      </div>
      <div>
        <p class="text-[22px] font-bold text-[#0f2854] leading-none">{{ $allUsers->count() }}</p>
        <p class="text-[12.5px] text-slate-500 mt-1">Total User</p>
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
        <p class="text-[22px] font-bold text-emerald-500 leading-none">{{ $allUsers->where('role', 'mahasiswa')->count() }}</p>
        <p class="text-[12.5px] text-slate-500 mt-1">Mahasiswa</p>
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
        <p class="text-[22px] font-bold text-purple-500 leading-none">{{ $allUsers->where('role', 'tendik')->count() }}</p>
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
        <p class="text-[22px] font-bold text-amber-500 leading-none">{{ $allUsers->where('role', 'staff')->count() }}</p>
        <p class="text-[12.5px] text-slate-500 mt-1">Staff</p>
      </div>
    </div>
  </div>
  <div class="bg-white rounded-[14px] p-5 shadow-sm border border-slate-100">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center">
        <svg class="w-5 h-5 stroke-red-500" viewBox="0 0 24 24" fill="none" stroke-width="2">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
      </div>
      <div>
        <p class="text-[22px] font-bold text-red-500 leading-none">{{ $allUsers->where('role', 'admin')->count() }}</p>
        <p class="text-[12.5px] text-slate-500 mt-1">Admin</p>
      </div>
    </div>
  </div>
</div>

{{-- Table --}}
<div class="bg-white rounded-[14px] shadow-sm border border-slate-100 overflow-hidden">
  <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
    <div>
      <h2 class="text-[15px] font-bold text-[#0f2854]">Daftar Pengguna</h2>
      <p class="text-xs text-slate-400 mt-0.5">{{ $users->total() }} pengguna terdaftar</p>
    </div>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full">
      <thead>
        <tr class="border-b border-slate-100">
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Nama</th>
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Email</th>
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">NIM/NIP</th>
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">No. HP</th>
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Role</th>
          <th class="text-center text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
          <td class="px-6 py-3.5">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#4a7fe5] to-blue-600 flex items-center justify-center text-[11px] font-bold text-white">
                {{ strtoupper(substr($user->name, 0, 2)) }}
              </div>
              <div class="text-[13px] font-semibold text-slate-700">{{ $user->name }}</div>
            </div>
          </td>
          <td class="px-6 py-3.5">
            <span class="text-[12px] text-slate-500">{{ $user->email }}</span>
          </td>
          <td class="px-6 py-3.5">
            <span class="text-[12px] text-slate-500">{{ $user->nim_nip ?? '—' }}</span>
          </td>
          <td class="px-6 py-3.5">
            <span class="text-[12px] text-slate-500">{{ $user->phone ?? '—' }}</span>
          </td>
          <td class="px-6 py-3.5">
            @switch($user->role)
              @case('admin')
                <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold bg-red-50 text-red-600 px-2.5 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Admin
                </span>
                @break
              @case('mahasiswa')
                <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold bg-emerald-50 text-emerald-600 px-2.5 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Mahasiswa
                </span>
                @break
              @case('tendik')
                <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold bg-purple-50 text-purple-600 px-2.5 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span> Tendik
                </span>
                @break
              @case('staff')
                <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold bg-amber-50 text-amber-600 px-2.5 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Staff
                </span>
                @break
              @default
                <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold bg-slate-100 text-slate-500 px-2.5 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> {{ ucfirst($user->role) }}
                </span>
            @endswitch
          </td>
          <td class="px-6 py-3.5">
            <div class="flex items-center justify-center gap-2">
              <button onclick="openEditModal({{ json_encode($user) }})"
                 class="text-[11px] font-semibold text-[#0f2854] bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg transition-colors">
                Edit
              </button>
              <button onclick="openDeleteModal('{{ $user->id }}', '{{ $user->name }}')"
                      class="text-[11px] font-semibold text-red-500 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors">
                Hapus
              </button>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-12 text-slate-400 text-sm">
            <svg class="w-10 h-10 mx-auto mb-3 stroke-slate-300" viewBox="0 0 24 24" fill="none" stroke-width="1.5">
              <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
            </svg>
            Belum ada pengguna terdaftar.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Pagination --}}
  @if($users->hasPages())
  <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between">
    <p class="text-[12px] text-slate-400">
      Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }} dari {{ $users->total() }} data
    </p>
    <div class="flex items-center gap-1">
      @if($users->onFirstPage())
        <span class="px-3 py-1.5 text-[12px] text-slate-300 bg-slate-50 rounded-lg cursor-not-allowed">&laquo; Prev</span>
      @else
        <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1.5 text-[12px] font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors no-underline">&laquo; Prev</a>
      @endif

      @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
        @if($page == $users->currentPage())
          <span class="px-3 py-1.5 text-[12px] font-semibold text-white bg-[#4a7fe5] rounded-lg">{{ $page }}</span>
        @else
          <a href="{{ $url }}" class="px-3 py-1.5 text-[12px] font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors no-underline">{{ $page }}</a>
        @endif
      @endforeach

      @if($users->hasMorePages())
        <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1.5 text-[12px] font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors no-underline">Next &raquo;</a>
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
        <h3 class="text-lg font-bold text-[#0f2854]">Tambah Pengguna</h3>
        <p class="text-xs text-slate-400 mt-0.5">Isi data pengguna baru.</p>
      </div>
      <button onclick="closeCreateModal()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
        <svg class="w-4 h-4 stroke-slate-500" viewBox="0 0 24 24" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>

    <form id="createForm" method="POST" action="{{ route('user.store') }}" onsubmit="return validateCreateForm()">
      @csrf

      {{-- Row 1: Nama + Role --}}
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Nama <span class="text-red-400">*</span></label>
          <input type="text" name="name" id="create_name" placeholder="Nama lengkap" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
          <p class="text-[11px] text-red-500 mt-1 hidden" id="err_create_name">Harus isi kolom ini</p>
        </div>
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Role <span class="text-red-400">*</span></label>
          <select name="role" id="create_role" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
            <option value="mahasiswa">Mahasiswa</option>
            <option value="tendik">Tendik</option>
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
          </select>
        </div>
      </div>

      {{-- Row 2: Email + Password --}}
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Email <span class="text-red-400">*</span></label>
          <input type="email" name="email" id="create_email" placeholder="email@example.com" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
          <p class="text-[11px] text-red-500 mt-1 hidden" id="err_create_email">Harus isi kolom ini</p>
        </div>
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Password <span class="text-red-400">*</span></label>
          <input type="password" name="password" id="create_password" placeholder="Min. 6 karakter" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
          <p class="text-[11px] text-red-500 mt-1 hidden" id="err_create_password">Harus isi kolom ini</p>
        </div>
      </div>

      {{-- Row 3: NIM/NIP + No. HP --}}
      <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">NIM/NIP</label>
          <input type="text" name="nim_nip" id="create_nim_nip" placeholder="Nomor induk" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
        </div>
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">No. HP</label>
          <input type="text" name="phone" id="create_phone" placeholder="08xxxxxxxxxx" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
        </div>
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
        <h3 class="text-lg font-bold text-[#0f2854]">Edit Pengguna</h3>
        <p class="text-xs text-slate-400 mt-0.5">Ubah data pengguna.</p>
      </div>
      <button onclick="closeEditModal()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
        <svg class="w-4 h-4 stroke-slate-500" viewBox="0 0 24 24" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>

    <form id="editForm" method="POST">
      @csrf
      @method('PUT')

      {{-- Row 1: Nama + Role --}}
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Nama</label>
          <input type="text" name="name" id="edit_name" placeholder="Nama lengkap" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
        </div>
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Role</label>
          <select name="role" id="edit_role" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
            <option value="mahasiswa">Mahasiswa</option>
            <option value="tendik">Tendik</option>
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
          </select>
        </div>
      </div>

      {{-- Row 2: Email + Password --}}
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Email</label>
          <input type="email" name="email" id="edit_email" placeholder="email@example.com" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
        </div>
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">Password <span class="text-slate-400 font-normal">(kosongkan jika tidak diubah)</span></label>
          <input type="password" name="password" id="edit_password" placeholder="Password baru" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
        </div>
      </div>

      {{-- Row 3: NIM/NIP + No. HP --}}
      <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">NIM/NIP</label>
          <input type="text" name="nim_nip" id="edit_nim_nip" placeholder="Nomor induk" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
        </div>
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5">No. HP</label>
          <input type="text" name="phone" id="edit_phone" placeholder="08xxxxxxxxxx" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
        </div>
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
      <h3 class="text-lg font-bold text-slate-800 mb-1">Hapus Pengguna</h3>
      <p class="text-sm text-slate-500 mb-6">Apakah Anda yakin ingin menghapus <strong id="deleteUserName" class="text-slate-700"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
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
      { id: 'create_name', errId: 'err_create_name' },
      { id: 'create_email', errId: 'err_create_email' },
      { id: 'create_password', errId: 'err_create_password' },
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

  // CREATE MODAL
  function openCreateModal() {
    document.getElementById('createForm').reset();
    document.querySelectorAll('[id^="err_create_"]').forEach(el => el.classList.add('hidden'));
    document.getElementById('createModal').classList.remove('hidden');
    document.getElementById('createModal').classList.add('flex');
  }
  function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
    document.getElementById('createModal').classList.remove('flex');
  }

  // EDIT MODAL
  function openEditModal(user) {
    document.getElementById('editForm').action = '/user/' + user.id;
    document.getElementById('edit_name').value = user.name;
    document.getElementById('edit_email').value = user.email;
    document.getElementById('edit_role').value = user.role;
    document.getElementById('edit_nim_nip').value = user.nim_nip || '';
    document.getElementById('edit_phone').value = user.phone || '';
    document.getElementById('edit_password').value = '';
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
  }
  function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
  }

  // DELETE MODAL
  function openDeleteModal(id, name) {
    document.getElementById('deleteUserName').textContent = name;
    document.getElementById('deleteForm').action = '/user/' + id;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
  }
  function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
  }
</script>

@endsection
