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
        <!-- Video Upload Input -->
        <div class="mb-4">
          <label class="block text-xs font-semibold text-slate-600 mb-2">Upload Video untuk Testing</label>
          <input type="file" id="videoInput" accept="video/*" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <p class="text-xs text-slate-500 mt-1">Format: MP4, AVI, MOV. Maksimal 50MB</p>
        </div>

        <!-- Camera Feed Container -->
        <div class="relative bg-slate-900 rounded-lg overflow-hidden aspect-video">
          <!-- Placeholder untuk kamera - bisa diganti dengan video stream -->
          <div id="cameraFeed" class="w-full h-full flex items-center justify-center">
            <div class="text-center">
              <svg class="w-16 h-16 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
              </svg>
              <p class="text-sm text-slate-500">Upload video untuk testing</p>
              <p class="text-xs text-slate-600 mt-1">atau hubungkan kamera untuk live feed</p>
            </div>
          </div>
          
          <!-- Camera Controls -->
          <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between">
            <button id="playPauseBtn" class="hidden bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
              <svg class="w-4 h-4 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
              </svg>
              <span id="playPauseText">Play</span>
            </button>
            <button id="snapshotBtn" class="bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
              <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              Snapshot
            </button>
            <button id="clearVideoBtn" class="hidden bg-red-500/80 backdrop-blur-sm hover:bg-red-600/80 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
              <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
              Clear
            </button>
          </div>
        </div>

        <!-- Camera Info -->
        <div class="mt-4 grid grid-cols-2 gap-3">
          <div class="bg-slate-50 rounded-lg p-3">
            <p class="text-xs text-slate-500 mb-1">Status</p>
            <p id="cameraStatus" class="text-sm font-semibold text-slate-700">Standby</p>
          </div>
          <div class="bg-slate-50 rounded-lg p-3">
            <p class="text-xs text-slate-500 mb-1">Source</p>
            <p id="cameraSource" class="text-sm font-semibold text-slate-700">-</p>
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

<!-- Script untuk video upload dan playback -->
<script>
let currentVideo = null;

// Handle video file upload
document.getElementById('videoInput').addEventListener('change', function(e) {
  const file = e.target.files[0];
  
  if (file) {
    // Validate file size (50MB max)
    if (file.size > 50 * 1024 * 1024) {
      alert('File terlalu besar! Maksimal 50MB');
      e.target.value = '';
      return;
    }
    
    // Validate file type
    if (!file.type.startsWith('video/')) {
      alert('File harus berformat video!');
      e.target.value = '';
      return;
    }
    
    // Create video element
    const videoUrl = URL.createObjectURL(file);
    loadVideo(videoUrl, file.name);
    
    // Update status
    document.getElementById('cameraStatus').textContent = 'Video Loaded';
    document.getElementById('cameraStatus').classList.add('text-green-600');
    document.getElementById('cameraSource').textContent = file.name;
  }
});

// Load video into player
function loadVideo(url, filename) {
  const cameraFeed = document.getElementById('cameraFeed');
  
  // Clear existing content
  cameraFeed.innerHTML = '';
  
  // Create video element
  const video = document.createElement('video');
  video.src = url;
  video.className = 'w-full h-full object-contain';
  video.controls = false;
  video.loop = true;
  
  cameraFeed.appendChild(video);
  currentVideo = video;
  
  // Show controls
  document.getElementById('playPauseBtn').classList.remove('hidden');
  document.getElementById('clearVideoBtn').classList.remove('hidden');
  
  // Auto play
  video.play();
  updatePlayPauseButton();
}

// Play/Pause button
document.getElementById('playPauseBtn').addEventListener('click', function() {
  if (currentVideo) {
    if (currentVideo.paused) {
      currentVideo.play();
    } else {
      currentVideo.pause();
    }
    updatePlayPauseButton();
  }
});

// Update play/pause button text and icon
function updatePlayPauseButton() {
  if (currentVideo) {
    const btn = document.getElementById('playPauseBtn');
    const text = document.getElementById('playPauseText');
    
    if (currentVideo.paused) {
      text.textContent = 'Play';
      btn.querySelector('svg').innerHTML = '<path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>';
    } else {
      text.textContent = 'Pause';
      btn.querySelector('svg').innerHTML = '<path d="M5.75 3a.75.75 0 00-.75.75v12.5c0 .414.336.75.75.75h1.5a.75.75 0 00.75-.75V3.75A.75.75 0 007.25 3h-1.5zM12.75 3a.75.75 0 00-.75.75v12.5c0 .414.336.75.75.75h1.5a.75.75 0 00.75-.75V3.75a.75.75 0 00-.75-.75h-1.5z"/>';
    }
  }
}

// Listen to video play/pause events
document.addEventListener('DOMContentLoaded', function() {
  const observer = new MutationObserver(function() {
    if (currentVideo) {
      currentVideo.addEventListener('play', updatePlayPauseButton);
      currentVideo.addEventListener('pause', updatePlayPauseButton);
    }
  });
});

// Snapshot button
document.getElementById('snapshotBtn').addEventListener('click', function() {
  if (currentVideo && !currentVideo.paused) {
    // Create canvas to capture frame
    const canvas = document.createElement('canvas');
    canvas.width = currentVideo.videoWidth;
    canvas.height = currentVideo.videoHeight;
    
    const ctx = canvas.getContext('2d');
    ctx.drawImage(currentVideo, 0, 0, canvas.width, canvas.height);
    
    // Convert to blob and download
    canvas.toBlob(function(blob) {
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = 'snapshot-' + Date.now() + '.jpg';
      a.click();
      URL.revokeObjectURL(url);
      
      // Show notification
      showNotification('Snapshot berhasil disimpan!');
    }, 'image/jpeg', 0.95);
  } else {
    alert('Video harus diputar untuk mengambil snapshot!');
  }
});

// Clear video button
document.getElementById('clearVideoBtn').addEventListener('click', function() {
  if (confirm('Hapus video yang sedang dimuat?')) {
    // Clear video
    const cameraFeed = document.getElementById('cameraFeed');
    cameraFeed.innerHTML = `
      <div class="text-center">
        <svg class="w-16 h-16 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
        </svg>
        <p class="text-sm text-slate-500">Upload video untuk testing</p>
        <p class="text-xs text-slate-600 mt-1">atau hubungkan kamera untuk live feed</p>
      </div>
    `;
    
    // Reset input
    document.getElementById('videoInput').value = '';
    currentVideo = null;
    
    // Hide controls
    document.getElementById('playPauseBtn').classList.add('hidden');
    document.getElementById('clearVideoBtn').classList.add('hidden');
    
    // Reset status
    document.getElementById('cameraStatus').textContent = 'Standby';
    document.getElementById('cameraStatus').classList.remove('text-green-600');
    document.getElementById('cameraSource').textContent = '-';
  }
});

// Show notification
function showNotification(message) {
  const notification = document.createElement('div');
  notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 animate-fade-in';
  notification.innerHTML = `
    <div class="flex items-center gap-2">
      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
      </svg>
      <span>${message}</span>
    </div>
  `;
  document.body.appendChild(notification);
  
  setTimeout(() => {
    notification.remove();
  }, 3000);
}

// Webcam option (uncomment to enable)
/*
function startWebcam() {
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function(stream) {
      const video = document.createElement('video');
      video.srcObject = stream;
      video.autoplay = true;
      video.className = 'w-full h-full object-cover';
      document.getElementById('cameraFeed').innerHTML = '';
      document.getElementById('cameraFeed').appendChild(video);
      currentVideo = video;
      
      document.getElementById('cameraStatus').textContent = 'Live';
      document.getElementById('cameraStatus').classList.add('text-green-600');
      document.getElementById('cameraSource').textContent = 'Webcam';
    })
    .catch(function(err) {
      console.error('Error accessing camera:', err);
      alert('Tidak dapat mengakses webcam!');
    });
}
*/

// Auto refresh log setiap 30 detik (disabled when video is playing)
setInterval(function() {
  if (!currentVideo || currentVideo.paused) {
    location.reload();
  }
}, 30000);
</script>

<style>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fade-in 0.3s ease-out;
}
</style>

@endsection
