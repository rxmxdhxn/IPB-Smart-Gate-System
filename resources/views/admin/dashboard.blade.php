@extends ('layouts.admin')

@section ('title', 'Dashboard')
@section ('page-title', 'Dashboard')

@section ('content')
  <!-- Statistics Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Kendaraan Masuk Hari Ini -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between mb-4">
        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
          <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
          </svg>
        </div>
        <span class="text-xs font-medium text-green-600 bg-green-50 px-2.5 py-1 rounded-full">Hari Ini</span>
      </div>
      <h3 id="todayInCount" class="text-2xl font-bold text-slate-800 mb-1">{{ $todayIn }}</h3>
      <p class="text-sm text-slate-500">Kendaraan Masuk</p>
    </div>

    <!-- Total Kendaraan Keluar Hari Ini -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between mb-4">
        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
          <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
          </svg>
        </div>
        <span class="text-xs font-medium text-red-600 bg-red-50 px-2.5 py-1 rounded-full">Hari Ini</span>
      </div>
      <h3 id="todayOutCount" class="text-2xl font-bold text-slate-800 mb-1">{{ $todayOut }}</h3>
      <p class="text-sm text-slate-500">Kendaraan Keluar</p>
    </div>

    <!-- Total Kendaraan Terdaftar -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between mb-4">
        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
          <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
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
          <div class="mb-4">
            <div class="grid grid-cols-2 gap-2">
              <button
                id="startLiveOcrBtn"
                type="button"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors">
                Start Live OCR
              </button>

              <button
                id="stopLiveOcrBtn"
                type="button"
                class="hidden bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors">
                Stop Live OCR
              </button>
            </div>

            <div
              id="liveOcrResult"
              class="hidden mt-3 rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm"></div>
          </div>

          <!-- Camera Feed Container -->
          <div class="relative bg-slate-900 rounded-lg overflow-hidden aspect-video">
            <!-- Placeholder untuk kamera - bisa diganti dengan video stream -->
            <div id="cameraFeed" class="w-full h-full flex items-center justify-center">
              <div class="text-center">
                <svg class="w-16 h-16 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <p class="text-sm text-slate-500">Hubungkan kamera untuk live feed</p>
                <p class="text-xs text-slate-600 mt-1">Tekan Start Live OCR untuk mulai membaca plat</p>
              </div>
            </div>

            <!-- Camera Controls -->
            <div class="absolute bottom-3 right-3 flex items-center justify-end">
              <button
                id="snapshotBtn"
                class="bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Snapshot
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
            <a
              href="{{ route('vehicle-log.index') }}"
              class="flex items-center gap-1.5 text-xs font-medium text-blue-600 hover:text-blue-700 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H7a2 2 0 01-2-2V10a2 2 0 012-2h3m5-3h4" />
              </svg>
              Lihat Semua
            </a>
            @if (request()->routeIs('vehicle-log.*'))
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
                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                  Plat Nomor
                </th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                  Pengemudi
                </th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tipe</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                  Status
                </th>
              </tr>
            </thead>
            <tbody id="recentLogsBody" class="divide-y divide-slate-200">
              @forelse ($recentLogs as $log)
                <tr data-log-row="true" class="hover:bg-slate-50 transition-colors">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-slate-900">{{ $log->logged_at->format('H:i') }}</div>
                    <div class="text-xs text-slate-500">{{ $log->logged_at->format('d M Y') }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-slate-900">{{ $log->plate_number }}</div>
                    @if ($log->vehicle)
                      <div class="text-xs text-slate-500">{{ $log->vehicle->brand }} {{ $log->vehicle->type }}</div>
                    @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-slate-700">
                      {{ $log->driver_name ?? ($log->vehicle->user->name ?? '-') }}
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-slate-700">{{ $log->vehicle->vehicle_type ?? '-' }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @if ($log->type === 'in')
                      <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                        </svg>
                        Masuk
                      </span>
                    @else
                      <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" transform="rotate(180 10 10)" />
                        </svg>
                        Keluar
                      </span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr id="recentLogsEmpty">
                  <td colspan="5" class="px-6 py-12 text-center">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
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
        @if ($recentLogs->hasPages())
          <div class="px-6 py-4 border-t border-slate-200">{{ $recentLogs->links() }}</div>
        @endif
      </div>
    </div>
  </div>
  <!-- Script untuk live OCR -->
  <script>
    let liveStream = null;
    let liveVideo = null;
    let liveOcrInterval = null;
    let isProcessingFrame = false;
    let lastDetectedPlate = null;
    let lastDetectedAt = 0;
    let matchBuffer = [];
    const REQUIRED_MATCHES = 3;

    // Snapshot button
    document.getElementById('snapshotBtn').addEventListener('click', function () {
      if (liveVideo && liveVideo.readyState >= 2) {
        // Create canvas to capture frame
        const canvas = document.createElement('canvas');
        canvas.width = liveVideo.videoWidth;
        canvas.height = liveVideo.videoHeight;

        const ctx = canvas.getContext('2d');
        ctx.drawImage(liveVideo, 0, 0, canvas.width, canvas.height);

        // Convert to blob and download
        canvas.toBlob(
          function (blob) {
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'snapshot-' + Date.now() + '.jpg';
            a.click();
            URL.revokeObjectURL(url);

            // Show notification
            showNotification('Snapshot berhasil disimpan!');
          },
          'image/jpeg',
          0.95,
        );
      } else {
        alert('Kamera harus aktif untuk mengambil snapshot!');
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
      if (liveStream) {
        return;
      }

      try {
        liveStream = await navigator.mediaDevices.getUserMedia({
          video: true,
          audio: false,
        });

        const cameraFeed = document.getElementById('cameraFeed');
        cameraFeed.innerHTML = '';

        liveVideo = document.createElement('video');
        liveVideo.srcObject = liveStream;
        liveVideo.autoplay = true;
        liveVideo.playsInline = true;
        liveVideo.muted = true;
        liveVideo.className = 'w-full h-full object-cover';

        cameraFeed.appendChild(liveVideo);

        document.getElementById('cameraStatus').textContent = 'Live OCR Active';
        document.getElementById('cameraStatus').classList.add('text-green-600');
        document.getElementById('cameraSource').textContent = 'Webcam OCR';

        startLiveOcrBtn.classList.add('hidden');
        stopLiveOcrBtn.classList.remove('hidden');

        liveOcrResult.classList.remove('hidden');
        liveOcrResult.innerHTML = `
          <p class="text-slate-600">Live OCR aktif. Kamera sedang membaca plat...</p>
        `;

        liveOcrInterval = setInterval(captureFrameForOcr, 2000);
        localStorage.setItem(liveOcrStorageKey, 'true');
      } catch (error) {
        console.error(error);
        if (options.silent !== true) {
          alert('Tidak bisa mengakses webcam. Pastikan izin kamera diizinkan.');
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

      if (liveStream) {
        liveStream.getTracks().forEach((track) => track.stop());
        liveStream = null;
      }

      liveVideo = null;
      isProcessingFrame = false;

      const cameraFeed = document.getElementById('cameraFeed');
      cameraFeed.innerHTML = `
        <div class="text-center">
          <svg class="w-16 h-16 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
          </svg>
          <p class="text-sm text-slate-500">Hubungkan kamera untuk live feed</p>
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
      if (!liveVideo || liveVideo.readyState < 2 || isProcessingFrame) {
        return;
      }

      isProcessingFrame = true;

      const canvas = document.createElement('canvas');
      canvas.width = liveVideo.videoWidth;
      canvas.height = liveVideo.videoHeight;

      const ctx = canvas.getContext('2d');
      ctx.drawImage(liveVideo, 0, 0, canvas.width, canvas.height);

      canvas.toBlob(
        async function (blob) {
          if (!blob) {
            isProcessingFrame = false;
            return;
          }

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
              matchBuffer.push(plate);
              if (matchBuffer.length > REQUIRED_MATCHES) {
                matchBuffer.shift();
              }
              const isConfirmed = matchBuffer.length === REQUIRED_MATCHES && matchBuffer.every((p) => p === plate);

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
                }

                matchBuffer = [];
              } else {
                liveOcrResult.classList.remove(
                  'bg-slate-50',
                  'border-slate-200',
                  'bg-red-50',
                  'border-red-200',
                  'bg-green-50',
                  'border-green-200',
                );
                liveOcrResult.classList.add('bg-yellow-50', 'border-yellow-200');

                liveOcrResult.innerHTML = `
              <p class="font-semibold text-slate-700">Memverifikasi PLat...</p>
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
          } finally {
            isProcessingFrame = false;
          }
        },
        'image/jpeg',
        0.9,
      );
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
        return `
          <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"/>
            </svg>
            Masuk
          </span>
        `;
      }

      return `
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
          <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" transform="rotate(180 10 10)"/>
          </svg>
          Keluar
        </span>
      `;
    }

    function recentLogRow(log) {
      const vehicleName = log.vehicle_name
        ? `<div class="text-xs text-slate-500">${escapeHtml(log.vehicle_name)}</div>`
        : '';

      return `
        <tr data-log-row="true" class="hover:bg-slate-50 transition-colors">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-slate-900">${escapeHtml(log.logged_time)}</div>
            <div class="text-xs text-slate-500">${escapeHtml(log.logged_date)}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-slate-900">${escapeHtml(log.plate_number)}</div>
            ${vehicleName}
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-slate-700">${escapeHtml(log.driver_name || '-')}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-slate-700">${escapeHtml(log.vehicle_type || '-')}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
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
