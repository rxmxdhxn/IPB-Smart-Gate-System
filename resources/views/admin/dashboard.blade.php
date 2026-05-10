@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <!-- Total Kendaraan Masuk Hari Ini -->
  <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
        </svg>
      </div>
      <span class="text-xs font-medium text-green-600 bg-green-50 px-2.5 py-1 rounded-full">Hari Ini</span>
    </div>
    <h3 class="text-2xl font-bold text-slate-800 mb-1">{{ $todayIn }}</h3>
    <p class="text-sm text-slate-500">Kendaraan Masuk</p>
  </div>

  <!-- Total Kendaraan Keluar Hari Ini -->
  <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
        </svg>
      </div>
      <span class="text-xs font-medium text-red-600 bg-red-50 px-2.5 py-1 rounded-full">Hari Ini</span>
    </div>
    <h3 class="text-2xl font-bold text-slate-800 mb-1">{{ $todayOut }}</h3>
    <p class="text-sm text-slate-500">Kendaraan Keluar</p>
  </div>


  <!-- Total Kendaraan Terdaftar -->
  <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
      </div>
      <span class="text-xs font-medium text-purple-600 bg-purple-50 px-2.5 py-1 rounded-full">Total</span>
    </div>
    <h3 class="text-2xl font-bold text-slate-800 mb-1">{{ $totalVehicles }}</h3>
    <p class="text-sm text-slate-500">Kendaraan Terdaftar</p>
  </div>
</div>

<!-- Camera Feed & Activity Log -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
  
  <!-- Camera Feed -->
  <div class="lg:col-span-3">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
        <div class="flex items-center justify-between">
          <h2 class="text-base font-semibold text-slate-800">Live Camera</h2>
          <span class="flex items-center gap-1.5 text-xs font-medium text-green-600">
            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
            Live
          </span>
        </div>
      </div>
      
      <div class="p-4">
        <!-- Camera Feed Container -->
        <div class="relative bg-slate-900 rounded-lg overflow-hidden aspect-video">
          <!-- Placeholder untuk kamera - bisa diganti dengan video stream -->
          <div id="cameraFeed" class="w-full h-full flex items-center justify-center">
            <div class="text-center">
              <svg class="w-16 h-16 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
              </svg>
              <p class="text-sm text-slate-500">Kamera Belum Terhubung</p>
              <p class="text-xs text-slate-600 mt-1">Hubungkan kamera untuk melihat live feed</p>
            </div>
          </div>
          
          <!-- Camera Controls -->
          <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between">
            <button class="bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
              <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              Snapshot
            </button>
            <button class="bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
              <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              Settings
            </button>
          </div>
        </div>

        <!-- Camera Info -->
        <div class="mt-4 grid grid-cols-2 gap-3">
          <div class="bg-slate-50 rounded-lg p-3">
            <p class="text-xs text-slate-500 mb-1">Status</p>
            <p class="text-sm font-semibold text-slate-700">Standby</p>
          </div>
          <div class="bg-slate-50 rounded-lg p-3">
            <p class="text-xs text-slate-500 mb-1">Resolusi</p>
            <p class="text-sm font-semibold text-slate-700">1920x1080</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Activity Log -->
  <div class="lg:col-span-4">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
        <div class="flex items-center justify-between">
          <h2 class="text-base font-semibold text-slate-800">Log Aktivitas Kendaraan</h2>
            <a href="{{ route('vehicle-log.index') }}" class="flex items-center gap-1.5 text-xs font-medium text-blue-600 hover:text-blue-700 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H7a2 2 0 01-2-2V10a2 2 0 012-2h3m5-3h4"/>
              </svg>
              Lihat Semua
            </a>
            @if(request()->routeIs('vehicle-log.*'))
                <span class="absolute left-0 top-1/2 -translate-y-1/2 w-[3px] h-5 bg-[#4a7fe5] rounded-r-[3px]"></span>
            @endif
            </a>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Waktu</th>
              <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Plat Nomor</th>
              <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Pengemudi</th>
              <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tipe</th>
              <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            @forelse($recentLogs as $log)
            <tr class="hover:bg-slate-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-slate-900">{{ $log->logged_at->format('H:i') }}</div>
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
            </tr>
            @empty
            <tr>
              <td colspan="5" class="px-6 py-12 text-center">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-sm text-slate-500">Belum ada log aktivitas</p>
                <p class="text-xs text-slate-400 mt-1">Log akan muncul ketika ada kendaraan masuk atau keluar</p>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      @if($recentLogs->hasPages())
      <div class="px-6 py-4 border-t border-slate-200">
        {{ $recentLogs->links() }}
      </div>
      @endif
    </div>
  </div>

</div>
<!-- 
Script untuk integrasi kamera (opsional) -->
<script>
// Contoh integrasi dengan kamera IP atau webcam
// Uncomment dan sesuaikan dengan setup kamera Anda

// navigator.mediaDevices.getUserMedia({ video: true })
//   .then(function(stream) {
//     const video = document.createElement('video');
//     video.srcObject = stream;
//     video.autoplay = true;
//     video.className = 'w-full h-full object-cover';
//     document.getElementById('cameraFeed').innerHTML = '';
//     document.getElementById('cameraFeed').appendChild(video);
//   })
//   .catch(function(err) {
//     console.error('Error accessing camera:', err);
//   });

/*
// Atau menggunakan IP Camera stream (MJPEG/RTSP)
const cameraUrl = 'http://your-camera-ip:port/video';
const img = document.createElement('img');
img.src = cameraUrl;
img.className = 'w-full h-full object-cover';
document.getElementById('cameraFeed').innerHTML = '';
document.getElementById('cameraFeed').appendChild(img);
*/

// Auto refresh log setiap 30 detik
setInterval(function() {
  location.reload();
}, 30000);
</script>

@endsection
