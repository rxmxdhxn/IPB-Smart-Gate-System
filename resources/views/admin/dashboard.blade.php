@extends ('layouts.admin')

@section ('title', 'Dashboard')
@section ('page-title', 'Dashboard')

@section ('content')
  <!-- Statistics Cards -->
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
    <!-- Total Kendaraan Masuk Hari Ini -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between mb-2">
        <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center">
          <svg class="w-4.5 h-4.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
          </svg>
        </div>
        <span class="text-[10px] font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Hari Ini</span>
      </div>
      <h3 id="todayInCount" class="text-xl font-bold text-slate-800 mb-0.5">{{ $todayIn }}</h3>
      <p class="text-xs text-slate-500">Kendaraan Masuk</p>
    </div>

    <!-- Total Kendaraan Keluar Hari Ini -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between mb-2">
        <div class="w-9 h-9 bg-red-100 rounded-lg flex items-center justify-center">
          <svg class="w-4.5 h-4.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
          </svg>
        </div>
        <span class="text-[10px] font-medium text-red-600 bg-red-50 px-2 py-0.5 rounded-full">Hari Ini</span>
      </div>
      <h3 id="todayOutCount" class="text-xl font-bold text-slate-800 mb-0.5">{{ $todayOut }}</h3>
      <p class="text-xs text-slate-500">Kendaraan Keluar</p>
    </div>

    <!-- Total Kendaraan di Dalam Kampus -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between mb-2">
        <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
          <svg class="w-4.5 h-4.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
        </div>
        <span class="text-[10px] font-medium text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">Hari Ini</span>
      </div>
      <h3 id="currentlyParkedCount" class="text-xl font-bold text-slate-800 mb-0.5">{{ $currentlyParked }}</h3>
      <p class="text-xs text-slate-500">Di Dalam Kampus</p>
    </div>

    <!-- Total Kendaraan Terdaftar -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between mb-2">
        <div class="w-9 h-9 bg-purple-100 rounded-lg flex items-center justify-center">
          <svg class="w-4.5 h-4.5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
        </div>
        <span class="text-[10px] font-medium text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full">Total</span>
      </div>
      <h3 class="text-xl font-bold text-slate-800 mb-0.5">{{ $totalVehicles }}</h3>
      <p class="text-xs text-slate-500">Kendaraan Terdaftar</p>
    </div>
  </div>
  <!-- Camera Feed & Activity Log -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Camera Feed -->
    <div class="lg:col-span-2">
      <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-5 py-3 border-b border-slate-200 bg-slate-50">
          <div class="flex items-center justify-between">
            <h2 class="text-sm font-semibold text-slate-800">Live Camera — TP-Link Tapo</h2>
            <span class="flex items-center gap-1.5 text-xs font-medium text-green-600">
              <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
              Live
            </span>
          </div>
        </div>

        <div class="p-3">
          <!-- Camera Feed Container -->
          <div class="relative bg-slate-900 rounded-lg overflow-hidden aspect-video">
            <!-- Live feed dari CCTV TP-Link Tapo via RTSP proxy -->
            <div id="cameraFeed" class="w-full h-full flex items-center justify-center">
              <div class="text-center">
                <svg class="w-12 h-12 text-slate-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <p class="text-xs text-slate-500">Hubungkan CCTV untuk live feed</p>
                <p class="text-xs text-slate-600 mt-0.5">Tekan Start Live OCR untuk mulai</p>
              </div>
            </div>

            <!-- Camera Controls -->
            <div class="absolute bottom-2 right-2 flex items-center justify-end">
              <button
                id="snapshotBtn"
                class="bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white px-2.5 py-1 rounded-md text-xs font-medium transition-colors">
                <svg class="w-3.5 h-3.5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Snapshot
              </button>
            </div>
          </div>

          <!-- Controls & Info -->
          <div class="mt-3 flex items-center gap-2">
            <button
              id="startLiveOcrBtn"
              type="button"
              class="flex-1 bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-xs font-semibold transition-colors">
              Start Live OCR
            </button>

            <button
              id="stopLiveOcrBtn"
              type="button"
              class="hidden flex-1 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-xs font-semibold transition-colors">
              Stop Live OCR
            </button>

            <div class="flex gap-2 text-xs">
              <div class="bg-slate-50 rounded-md px-2.5 py-1.5 border border-slate-200">
                <span class="text-slate-500">Status:</span>
                <span id="cameraStatus" class="font-semibold text-slate-700 ml-1">Standby</span>
              </div>
              <div class="bg-slate-50 rounded-md px-2.5 py-1.5 border border-slate-200">
                <span class="text-slate-500">Source:</span>
                <span id="cameraSource" class="font-semibold text-slate-700 ml-1">-</span>
              </div>
            </div>
          </div>

          <div
            id="liveOcrResult"
            class="hidden mt-3 rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm"></div>
        </div>
      </div>
    </div>

    <!-- Activity Log (beside camera) -->
    <div class="lg:col-span-1">
      <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden h-full flex flex-col">
        <div class="px-4 py-3 border-b border-slate-200 bg-slate-50">
          <div class="flex items-center justify-between">
            <h2 class="text-sm font-semibold text-slate-800">Log Aktivitas</h2>
            <a
              href="{{ route('vehicle-log.index') }}"
              class="text-xs font-medium text-blue-600 hover:text-blue-700 transition-colors">
              Lihat Semua
            </a>
          </div>
        </div>

        <div class="overflow-y-auto flex-1">
          <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200 sticky top-0">
              <tr>
                <th class="px-3 py-2 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Waktu</th>
                <th class="px-3 py-2 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Plat</th>
                <th class="px-3 py-2 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
              </tr>
            </thead>
            <tbody id="recentLogsBody" class="divide-y divide-slate-200">
              @forelse ($recentLogs as $log)
                <tr data-log-row="true" class="hover:bg-slate-50 transition-colors">
                  <td class="px-3 py-2.5 whitespace-nowrap">
                    <div class="text-xs text-slate-900">{{ $log->logged_at->format('H:i:s') }}</div>
                    <div class="text-[10px] text-slate-400">{{ $log->logged_at->format('d/m/Y') }}</div>
                  </td>
                  <td class="px-3 py-2.5 whitespace-nowrap">
                    <div class="text-xs font-semibold text-slate-900">{{ $log->plate_number }}</div>
                    @if ($log->vehicle && $log->vehicle->user)
                      <div class="text-[10px] text-slate-500">{{ $log->vehicle->user->name }}</div>
                      <div class="text-[10px] text-slate-400 capitalize">{{ $log->vehicle->user->role ?? '-' }}</div>
                    @elseif ($log->driver_name)
                      <div class="text-[10px] text-slate-500">{{ $log->driver_name }}</div>
                    @endif
                  </td>
                  <td class="px-3 py-2.5 whitespace-nowrap">
                    @if ($log->type === 'in')
                      <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-green-100 text-green-700">
                        Masuk
                      </span>
                    @else
                      <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-red-100 text-red-700">
                        Keluar
                      </span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr id="recentLogsEmpty">
                  <td colspan="3" class="px-4 py-8 text-center">
                    <p class="text-xs text-slate-500">Belum ada log aktivitas</p>
                    <p class="text-[10px] text-slate-400 mt-1">Log muncul saat kendaraan masuk/keluar</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
  <!-- Script untuk live OCR -->
  <script>
    let liveOcrInterval = null;
    let isProcessingFrame = false;
    let lastDetectedPlate = null;
    let lastDetectedAt = 0;
    let matchBuffer = [];
    let cameraActive = false;
    let cooldownActive = false;
    let cooldownTimer = null;
    const REQUIRED_MATCHES = 3;
    const DETECTION_COOLDOWN_MS = 10000; // 10 seconds delay after successful detection

    // RTSP Proxy configuration
    const RTSP_PROXY_URL = 'http://127.0.0.1:8002';
    const VIDEO_FEED_URL = RTSP_PROXY_URL + '/video_feed';
    const SNAPSHOT_URL = RTSP_PROXY_URL + '/snapshot';
    const STATUS_URL = RTSP_PROXY_URL + '/status';

    // Snapshot button
    document.getElementById('snapshotBtn').addEventListener('click', async function () {
      if (!cameraActive) {
        alert('Kamera harus aktif untuk mengambil snapshot!');
        return;
      }

      try {
        const response = await fetch(SNAPSHOT_URL);
        if (!response.ok) throw new Error('Gagal mengambil snapshot');

        const blob = await response.blob();
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'snapshot-' + Date.now() + '.jpg';
        a.click();
        URL.revokeObjectURL(url);

        showNotification('Snapshot berhasil disimpan!');
      } catch (error) {
        console.error(error);
        alert('Gagal mengambil snapshot. Pastikan RTSP proxy aktif.');
      }
    });

    // Show notification
    function showNotification(message, type = 'success') {
      let bgColor, icon;

      switch (type) {
        case 'success':
          bgColor = 'bg-green-500';
          icon =
            '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>';
          break;
        case 'error':
          bgColor = 'bg-red-500';
          icon =
            '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>';
          break;
        case 'warning':
          bgColor = 'bg-yellow-500';
          icon =
            '<path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>';
          break;
        default:
          bgColor = 'bg-blue-500';
          icon =
            '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>';
      }

      const notification = document.createElement('div');
      notification.className = `fixed top-4 right-4 ${bgColor} text-white px-4 py-3 rounded-lg shadow-lg z-50 animate-fade-in max-w-md`;
      notification.innerHTML = `
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            ${icon}
          </svg>
          <span class="text-sm">${message}</span>
        </div>
      `;
      document.body.appendChild(notification);

      setTimeout(() => {
        notification.remove();
      }, 4000);
    }

    const startLiveOcrBtn = document.getElementById('startLiveOcrBtn');
    const stopLiveOcrBtn = document.getElementById('stopLiveOcrBtn');
    const liveOcrResult = document.getElementById('liveOcrResult');
    const liveOcrStorageKey = 'smartParkingLiveOcrEnabled';

    startLiveOcrBtn.addEventListener('click', function () {
      startLiveOcr();
    });

    async function startLiveOcr(options = {}) {
      if (cameraActive) {
        return;
      }

      try {
        // Check if RTSP proxy is running
        const statusResponse = await fetch(STATUS_URL);
        const statusData = await statusResponse.json();

        if (!statusData.connected) {
          throw new Error('RTSP stream not connected');
        }

        const cameraFeed = document.getElementById('cameraFeed');
        cameraFeed.innerHTML = '';

        // Use MJPEG stream from RTSP proxy via <img> tag
        const streamImg = document.createElement('img');
        streamImg.src = VIDEO_FEED_URL;
        streamImg.className = 'w-full h-full object-cover';
        streamImg.alt = 'Live CCTV Feed';
        streamImg.id = 'liveStreamImg';

        cameraFeed.appendChild(streamImg);
        cameraActive = true;

        document.getElementById('cameraStatus').textContent = 'Live OCR Active';
        document.getElementById('cameraStatus').classList.add('text-green-600');
        document.getElementById('cameraSource').textContent = 'TP-Link Tapo CCTV (RTSP)';

        startLiveOcrBtn.classList.add('hidden');
        stopLiveOcrBtn.classList.remove('hidden');

        liveOcrResult.classList.remove('hidden');
        liveOcrResult.innerHTML = `
          <p class="text-slate-600">Live OCR aktif. CCTV sedang membaca plat...</p>
        `;

        liveOcrInterval = setInterval(captureFrameForOcr, 2000);
        localStorage.setItem(liveOcrStorageKey, 'true');
      } catch (error) {
        console.error(error);
        if (options.silent !== true) {
          alert('Tidak bisa terhubung ke CCTV. Pastikan RTSP proxy (rtsp_proxy.py) berjalan di port 8002.');
        }
      }
    }

    stopLiveOcrBtn.addEventListener('click', function () {
      stopLiveOcr();
    });

    function stopLiveOcr() {
      localStorage.removeItem(liveOcrStorageKey);

      if (liveOcrInterval) {
        clearInterval(liveOcrInterval);
        liveOcrInterval = null;
      }

      if (cooldownTimer) {
        clearInterval(cooldownTimer);
        cooldownTimer = null;
      }
      cooldownActive = false;

      cameraActive = false;
      isProcessingFrame = false;

      const cameraFeed = document.getElementById('cameraFeed');
      cameraFeed.innerHTML = `
        <div class="text-center">
          <svg class="w-16 h-16 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
          </svg>
          <p class="text-sm text-slate-500">Hubungkan CCTV untuk live feed</p>
          <p class="text-xs text-slate-600 mt-1">Tekan Start Live OCR untuk mulai membaca plat</p>
        </div>
      `;

      document.getElementById('cameraStatus').textContent = 'Standby';
      document.getElementById('cameraStatus').classList.remove('text-green-600');
      document.getElementById('cameraSource').textContent = '-';

      startLiveOcrBtn.classList.remove('hidden');
      stopLiveOcrBtn.classList.add('hidden');

      liveOcrResult.classList.add('hidden');
    }

    if (localStorage.getItem(liveOcrStorageKey) === 'true') {
      startLiveOcr({ silent: true });
    }

    async function captureFrameForOcr() {
      if (!cameraActive || isProcessingFrame || cooldownActive) {
        return;
      }

      isProcessingFrame = true;

      try {
        // Fetch snapshot from RTSP proxy
        const snapshotResponse = await fetch(SNAPSHOT_URL);
        if (!snapshotResponse.ok) {
          isProcessingFrame = false;
          return;
        }

        const blob = await snapshotResponse.blob();
        const formData = new FormData();
        formData.append('file', blob, 'frame.jpg');

        try {
          const response = await fetch('http://127.0.0.1:8001/predict-frame', {
            method: 'POST',
            body: formData,
          });

          const result = await response.json();

          if (result.success) {
            const plate = result.final_plate;
            const hasMismatch = matchBuffer.length > 0 && matchBuffer.some((p) => p !== plate);

            if (hasMismatch) {
              matchBuffer = [];

              liveOcrResult.classList.remove(
                'bg-slate-50', 'border-slate-200',
                'bg-green-50', 'border-green-200',
                'bg-yellow-50', 'border-yellow-200',
              );
              liveOcrResult.classList.add('bg-red-50', 'border-red-200');

              liveOcrResult.innerHTML = `
                <p class="font-semibold text-red-700">Verifikasi plat diulang</p>
                <p class="text-sm text-red-600">Hasil pemindaian tidak sesuai dari ${REQUIRED_MATCHES} frame.</p>
                <p class="text-sm text-slate-500">${plate}</p>
              `;

              document.getElementById('cameraStatus').textContent = 'Verification Reset';
              return;
            }

            matchBuffer.push(plate);
            const isConfirmed = matchBuffer.length === REQUIRED_MATCHES;

            if (isConfirmed) {
              const now = Date.now();

              liveOcrResult.classList.remove('bg-slate-50', 'border-slate-200', 'bg-red-50', 'border-red-200');
              liveOcrResult.classList.add('bg-green-50', 'border-green-200');

              liveOcrResult.innerHTML = `
                <div class="space-y-2">
                  <p class="font-semibold text-green-700">Plat Terdeteksi</p>
                  <div class="bg-white border border-green-200 rounded-lg p-3">
                    <p class="text-xs text-slate-500 mb-1">Nomor Plat</p>
                    <p class="text-xl font-bold text-slate-900">${plate}</p>
                  </div>
                </div>
              `;

              document.getElementById('cameraStatus').textContent = 'Plate Detected';

              if (plate !== lastDetectedPlate || now - lastDetectedAt > 10000) {
                lastDetectedPlate = plate;
                lastDetectedAt = now;

                await sendDetectedPlateToLaravel(plate);
                startCooldown(plate);
              }

              matchBuffer = [];
            } else {
              liveOcrResult.classList.remove(
                'bg-slate-50', 'border-slate-200',
                'bg-red-50', 'border-red-200',
                'bg-green-50', 'border-green-200',
              );
              liveOcrResult.classList.add('bg-yellow-50', 'border-yellow-200');

              liveOcrResult.innerHTML = `
                <p class="font-semibold text-slate-700">Memverifikasi Plat...</p>
                <p class="text-sm text-yellow-600">Menahan frame untuk akurasi. (${matchBuffer.length}/${REQUIRED_MATCHES})</p>
                <p class="text-sm text-slate-500">${plate}</p>
              `;

              document.getElementById('cameraStatus').textContent = 'Scanning...';
            }
          }
        } catch (error) {
          console.error(error);

          liveOcrResult.classList.remove('bg-slate-50', 'border-slate-200', 'bg-green-50', 'border-green-200');
          liveOcrResult.classList.add('bg-red-50', 'border-red-200');

          liveOcrResult.innerHTML = `
            <p class="font-semibold text-red-700">Gagal menghubungi API Python</p>
            <p class="text-sm text-red-600">Pastikan API Python berjalan di http://127.0.0.1:8001</p>
          `;
        }
      } catch (error) {
        console.error('Snapshot fetch error:', error);
      } finally {
        isProcessingFrame = false;
      }
    }

    function startCooldown(plate) {
      cooldownActive = true;
      let remaining = DETECTION_COOLDOWN_MS / 1000;

      document.getElementById('cameraStatus').textContent = `Cooldown (${remaining}s)`;

      liveOcrResult.classList.remove('bg-slate-50', 'border-slate-200', 'bg-red-50', 'border-red-200', 'bg-yellow-50', 'border-yellow-200');
      liveOcrResult.classList.add('bg-green-50', 'border-green-200');

      liveOcrResult.innerHTML = `
        <div class="space-y-2">
          <p class="font-semibold text-green-700">✓ Plat Berhasil Diproses</p>
          <div class="bg-white border border-green-200 rounded-lg p-3">
            <p class="text-xs text-slate-500 mb-1">Nomor Plat</p>
            <p class="text-xl font-bold text-slate-900">${plate}</p>
          </div>
          <p class="text-sm text-slate-500">Menunggu <span id="cooldownSeconds">${remaining}</span> detik sebelum scan berikutnya...</p>
        </div>
      `;

      cooldownTimer = setInterval(() => {
        remaining--;
        const cooldownEl = document.getElementById('cooldownSeconds');
        if (cooldownEl) {
          cooldownEl.textContent = remaining;
        }
        document.getElementById('cameraStatus').textContent = `Cooldown (${remaining}s)`;

        if (remaining <= 0) {
          clearInterval(cooldownTimer);
          cooldownTimer = null;
          cooldownActive = false;

          document.getElementById('cameraStatus').textContent = 'Live OCR Active';
          liveOcrResult.classList.remove('bg-green-50', 'border-green-200');
          liveOcrResult.classList.add('bg-slate-50', 'border-slate-200');
          liveOcrResult.innerHTML = `
            <p class="text-slate-600">Live OCR aktif. CCTV sedang membaca plat...</p>
          `;
        }
      }, 1000);
    }

    function appendLiveOcrMessage(message, type = 'info') {
      const messageElement = document.createElement('p');
      const textColor = type === 'success' ? 'text-green-700' : type === 'warning' ? 'text-yellow-700' : 'text-red-700';

      messageElement.className = `mt-2 text-sm font-medium ${textColor}`;
      messageElement.textContent = message;
      liveOcrResult.appendChild(messageElement);
    }

    function escapeHtml(value) {
      return String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
    }

    function statusBadge(type) {
      if (type === 'in') {
        return `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-green-100 text-green-700">Masuk</span>`;
      }
      return `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-red-100 text-red-700">Keluar</span>`;
    }

    function recentLogRow(log) {
      const driverInfo = log.driver_name
        ? `<div class="text-[10px] text-slate-500">${escapeHtml(log.driver_name)}</div>` +
          (log.driver_role ? `<div class="text-[10px] text-slate-400 capitalize">${escapeHtml(log.driver_role)}</div>` : '')
        : '';

      return `
        <tr data-log-row="true" class="hover:bg-slate-50 transition-colors">
          <td class="px-3 py-2.5 whitespace-nowrap">
            <div class="text-xs text-slate-900">${escapeHtml(log.logged_time)}</div>
            <div class="text-[10px] text-slate-400">${escapeHtml(log.logged_date)}</div>
          </td>
          <td class="px-3 py-2.5 whitespace-nowrap">
            <div class="text-xs font-semibold text-slate-900">${escapeHtml(log.plate_number)}</div>
            ${driverInfo}
          </td>
          <td class="px-3 py-2.5 whitespace-nowrap">
            ${statusBadge(log.type)}
          </td>
        </tr>
      `;
    }

    function setCounterText(id, value) {
      const element = document.getElementById(id);

      if (element && value !== undefined && value !== null) {
        element.textContent = value;
      }
    }

    function refreshDashboardLog(result) {
      if (!result.log) {
        return;
      }

      const recentLogsBody = document.getElementById('recentLogsBody');
      const emptyRow = document.getElementById('recentLogsEmpty');

      if (emptyRow) {
        emptyRow.remove();
      }

      recentLogsBody.insertAdjacentHTML('afterbegin', recentLogRow(result.log));

      recentLogsBody.querySelectorAll('tr[data-log-row="true"]').forEach(function (row, index) {
        if (index >= 10) {
          row.remove();
        }
      });

      if (result.stats) {
        setCounterText('todayInCount', result.stats.today_in);
        setCounterText('todayOutCount', result.stats.today_out);
      }
    }

    async function sendDetectedPlateToLaravel(plate) {
      console.log('Plat untuk proses lanjutan:', plate);

      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (!csrfToken) {
          throw new Error('CSRF token tidak ditemukan. Refresh halaman lalu coba lagi.');
        }

        const response = await fetch('{{ route('vehicle-log.store-detection') }}', {
          method: 'POST',
          credentials: 'same-origin',
          headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
            'X-CSRF-TOKEN': csrfToken,
          },
          body: JSON.stringify({
            plate_number: plate,
          }),
        });

        const result = await response.json().catch(() => ({
          message: 'Response Laravel tidak bisa dibaca.',
        }));

        if (!response.ok || !result.success) {
          const message = result.message || 'Log deteksi gagal disimpan.';
          const type = response.status === 404 ? 'warning' : 'error';

          appendLiveOcrMessage(message, type);
          showNotification(message, type);
          return false;
        }

        appendLiveOcrMessage(result.message, 'success');
        showNotification(result.message, 'success');
        document.getElementById('cameraStatus').textContent = 'Log Saved';
        refreshDashboardLog(result);

        return true;
      } catch (error) {
        const message = 'Gagal menyimpan log: ' + error.message;

        console.error('Laravel log error:', error);
        appendLiveOcrMessage(message, 'error');
        showNotification(message, 'error');
        return false;
      }
    }
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

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    .animate-spin {
      animation: spin 1s linear infinite;
    }
  </style>

@endsection
