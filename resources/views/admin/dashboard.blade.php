@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-8">
  <div>
    <div class="text-xl font-bold text-[#0f2854]">Overview</div>
    <div class="text-sm text-slate-500 mt-1">Selamat datang kembali, Admin</div>
  </div>
  <button class="flex items-center gap-2 px-5 py-2.5 bg-[#4a7fe5] text-white text-sm font-semibold rounded-[10px] hover:bg-[#3a6fd5] transition-colors shadow-md shadow-[#4a7fe5]/20">
    <svg class="w-4 h-4 stroke-white" viewBox="0 0 24 24" fill="none" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    Tambah Baru
  </button>
</div>

{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
  <div class="bg-white rounded-[14px] p-5 shadow-sm border border-slate-100">
    <div class="flex items-center justify-between mb-4">
      <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
        <svg class="w-5 h-5 stroke-[#4a7fe5]" viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
      </div>
      <span class="text-[11px] font-semibold px-2 py-[3px] rounded-full bg-emerald-50 text-emerald-500">+12%</span>
    </div>
    <div class="text-[26px] font-bold text-[#0f2854] leading-none">248</div>
    <div class="text-[12.5px] text-slate-500 mt-[5px]">Total Users</div>
  </div>

  <div class="bg-white rounded-[14px] p-5 shadow-sm border border-slate-100">
    <div class="flex items-center justify-between mb-4">
      <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
        <svg class="w-5 h-5 stroke-emerald-500" viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4l3 5v3h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
      </div>
      <span class="text-[11px] font-semibold px-2 py-[3px] rounded-full bg-emerald-50 text-emerald-500">+3%</span>
    </div>
    <div class="text-[26px] font-bold text-[#0f2854] leading-none">42</div>
    <div class="text-[12.5px] text-slate-500 mt-[5px]">Total Kendaraan</div>
  </div>

  <div class="bg-white rounded-[14px] p-5 shadow-sm border border-slate-100">
    <div class="flex items-center justify-between mb-4">
      <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
        <svg class="w-5 h-5 stroke-amber-500" viewBox="0 0 24 24" fill="none" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
      </div>
      <span class="text-[11px] font-semibold px-2 py-[3px] rounded-full bg-emerald-50 text-emerald-500">+7%</span>
    </div>
    <div class="text-[26px] font-bold text-[#0f2854] leading-none">38</div>
    <div class="text-[12.5px] text-slate-500 mt-[5px]">Aktif Hari Ini</div>
  </div>

  <div class="bg-white rounded-[14px] p-5 shadow-sm border border-slate-100">
    <div class="flex items-center justify-between mb-4">
      <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center">
        <svg class="w-5 h-5 stroke-red-500" viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      </div>
      <span class="text-[11px] font-semibold px-2 py-[3px] rounded-full bg-red-50 text-red-500">4</span>
    </div>
    <div class="text-[26px] font-bold text-[#0f2854] leading-none">4</div>
    <div class="text-[12.5px] text-slate-500 mt-[5px]">Perlu Perhatian</div>
  </div>
</div>

{{-- Bottom Section --}}
<div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
  {{-- Table Card --}}
  <div class="lg:col-span-3 bg-white rounded-[14px] shadow-sm border border-slate-100 overflow-hidden">
    <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
      <div>
        <div class="text-[15px] font-bold text-[#0f2854]">Pengguna Terbaru</div>
        <div class="text-xs text-slate-400 mt-0.5">4 pengguna terdaftar baru-baru ini</div>
      </div>
      <a href="#" class="text-xs font-semibold text-[#4a7fe5] hover:underline no-underline">Lihat Semua &rarr;</a>
    </div>
    <table class="w-full">
      <thead>
        <tr class="border-b border-slate-100">
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Pengguna</th>
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Role</th>
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Status</th>
          <th class="text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-6 py-3">Bergabung</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
          <td class="px-6 py-3">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-[11px] font-bold text-white">AR</div>
              <div>
                <div class="text-[13px] font-semibold text-slate-700">Andi Ramadhan</div>
                <div class="text-[11px] text-slate-400">andi@mail.com</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-3"><span class="text-[11px] font-medium text-slate-500 bg-slate-100 px-2.5 py-1 rounded-md">Driver</span></td>
          <td class="px-6 py-3"><span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Aktif</span></td>
          <td class="px-6 py-3 text-xs text-slate-400">2 Mei 2025</td>
        </tr>
        <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
          <td class="px-6 py-3">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center text-[11px] font-bold text-white">SN</div>
              <div>
                <div class="text-[13px] font-semibold text-slate-700">Sari Novita</div>
                <div class="text-[11px] text-slate-400">sari@mail.com</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-3"><span class="text-[11px] font-medium text-slate-500 bg-slate-100 px-2.5 py-1 rounded-md">Admin</span></td>
          <td class="px-6 py-3"><span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Aktif</span></td>
          <td class="px-6 py-3 text-xs text-slate-400">29 Apr 2025</td>
        </tr>
        <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
          <td class="px-6 py-3">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-[11px] font-bold text-white">BH</div>
              <div>
                <div class="text-[13px] font-semibold text-slate-700">Budi Hartono</div>
                <div class="text-[11px] text-slate-400">budi@mail.com</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-3"><span class="text-[11px] font-medium text-slate-500 bg-slate-100 px-2.5 py-1 rounded-md">Driver</span></td>
          <td class="px-6 py-3"><span class="text-[11px] font-semibold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full">Pending</span></td>
          <td class="px-6 py-3 text-xs text-slate-400">27 Apr 2025</td>
        </tr>
        <tr class="hover:bg-slate-50/50 transition-colors">
          <td class="px-6 py-3">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center text-[11px] font-bold text-white">DK</div>
              <div>
                <div class="text-[13px] font-semibold text-slate-700">Dewi Kartika</div>
                <div class="text-[11px] text-slate-400">dewi@mail.com</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-3"><span class="text-[11px] font-medium text-slate-500 bg-slate-100 px-2.5 py-1 rounded-md">Viewer</span></td>
          <td class="px-6 py-3"><span class="text-[11px] font-semibold text-slate-400 bg-slate-100 px-2.5 py-1 rounded-full">Nonaktif</span></td>
          <td class="px-6 py-3 text-xs text-slate-400">20 Apr 2025</td>
        </tr>
      </tbody>
    </table>
  </div>

  {{-- Activity Card --}}
  <div class="lg:col-span-2 bg-white rounded-[14px] shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100">
      <div class="text-[15px] font-bold text-[#0f2854]">Aktivitas Terkini</div>
      <div class="text-xs text-slate-400 mt-0.5">Real-time log</div>
    </div>
    <div class="px-6 py-4">
      <div class="flex gap-3 pb-5">
        <div class="flex flex-col items-center">
          <div class="w-2.5 h-2.5 rounded-full bg-[#4a7fe5] flex-shrink-0 mt-1.5"></div>
          <div class="w-px flex-1 bg-slate-200 mt-1"></div>
        </div>
        <div>
          <div class="text-[13px] text-slate-600"><strong class="text-slate-700">Kendaraan B-1234-XY</strong> mulai beroperasi</div>
          <div class="text-[11px] text-slate-400 mt-1">5 menit lalu</div>
        </div>
      </div>
      <div class="flex gap-3 pb-5">
        <div class="flex flex-col items-center">
          <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 flex-shrink-0 mt-1.5"></div>
          <div class="w-px flex-1 bg-slate-200 mt-1"></div>
        </div>
        <div>
          <div class="text-[13px] text-slate-600"><strong class="text-slate-700">Andi Ramadhan</strong> login ke sistem</div>
          <div class="text-[11px] text-slate-400 mt-1">12 menit lalu</div>
        </div>
      </div>
      <div class="flex gap-3 pb-5">
        <div class="flex flex-col items-center">
          <div class="w-2.5 h-2.5 rounded-full bg-amber-500 flex-shrink-0 mt-1.5"></div>
          <div class="w-px flex-1 bg-slate-200 mt-1"></div>
        </div>
        <div>
          <div class="text-[13px] text-slate-600">Servis terjadwal untuk <strong class="text-slate-700">D-5678-ZZ</strong></div>
          <div class="text-[11px] text-slate-400 mt-1">1 jam lalu</div>
        </div>
      </div>
      <div class="flex gap-3 pb-5">
        <div class="flex flex-col items-center">
          <div class="w-2.5 h-2.5 rounded-full bg-red-500 flex-shrink-0 mt-1.5"></div>
          <div class="w-px flex-1 bg-slate-200 mt-1"></div>
        </div>
        <div>
          <div class="text-[13px] text-slate-600">Laporan dari <strong class="text-slate-700">Budi Hartono</strong> masuk</div>
          <div class="text-[11px] text-slate-400 mt-1">2 jam lalu</div>
        </div>
      </div>
      <div class="flex gap-3">
        <div class="flex flex-col items-center">
          <div class="w-2.5 h-2.5 rounded-full bg-[#4a7fe5] flex-shrink-0 mt-1.5"></div>
        </div>
        <div>
          <div class="text-[13px] text-slate-600"><strong class="text-slate-700">Sari Novita</strong> menambah 2 user baru</div>
          <div class="text-[11px] text-slate-400 mt-1">3 jam lalu</div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
