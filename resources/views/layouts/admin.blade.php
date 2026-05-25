<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>@yield('title', 'Admin Panel')</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-slate-50 flex min-h-screen text-slate-700">

<!-- SIDEBAR -->
<aside class="w-60 h-screen bg-[#0f2854] flex flex-col flex-shrink-0 relative overflow-hidden sticky top-0">
  <div class="absolute -top-[60px] -right-[60px] w-[180px] h-[180px] rounded-full bg-white/[0.04] pointer-events-none"></div>

  <div class="px-6 pt-7 pb-6 border-b border-white/[0.08]">
    <div class="flex items-center gap-2.5">
      <div class="w-9 h-9 bg-[#4a7fe5] rounded-[10px] flex items-center justify-center">
        <svg class="w-[18px] h-[18px] fill-none stroke-white stroke-[2]" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><line x1="12" y1="4" x2="12" y2="20"/><line x1="3" y1="12" x2="21" y2="12"/><path d="M7 8h2M15 8h2M7 16h2M15 16h2"/></svg>
      </div>
      <div>
        <div class="text-[15px] font-bold text-white tracking-wide">Smart Gate</div>
      </div>
    </div>
  </div>

  <nav class="px-3.5 py-5 flex-1">
    <div class="text-[10px] font-semibold text-white/30 tracking-[1.2px] uppercase px-2.5 mb-2">Main</div>
    <a href="{{ route('dashboard') }}" class="flex items-center gap-[11px] px-3 py-2.5 rounded-[9px] mb-0.5 text-[13.5px] font-medium relative no-underline transition-all duration-[180ms] {{ request()->routeIs('dashboard') ? 'bg-[#4a7fe5]/20 text-white' : 'text-white/55 hover:bg-white/[0.07] hover:text-white/90' }}">
      @if(request()->routeIs('dashboard'))
        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-[3px] h-5 bg-[#4a7fe5] rounded-r-[3px]"></span>
      @endif
      <svg class="w-4 h-4 flex-shrink-0 opacity-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
        <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
      </svg>
      Dashboard
    </a>

    <div class="text-[10px] font-semibold text-white/30 tracking-[1.2px] uppercase px-2.5 mb-2 mt-5">Management</div>
    <a href="{{ route('user.index') }}" class="flex items-center gap-[11px] px-3 py-2.5 rounded-[9px] mb-0.5 text-[13.5px] font-medium transition-all duration-[180ms] no-underline relative {{ request()->routeIs('user.*') ? 'bg-[#4a7fe5]/20 text-white' : 'text-white/55 hover:bg-white/[0.07] hover:text-white/90' }}">
      @if(request()->routeIs('user.*'))
        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-[3px] h-5 bg-[#4a7fe5] rounded-r-[3px]"></span>
      @endif
      <svg class="w-4 h-4 flex-shrink-0 opacity-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
        <circle cx="9" cy="7" r="4"/>
        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
      </svg>
      User
    </a>

    <a href="{{ route('vehicle.index') }}" class="flex items-center gap-[11px] px-3 py-2.5 rounded-[9px] mb-0.5 text-[13.5px] font-medium transition-all duration-[180ms] no-underline relative {{ request()->routeIs('vehicle.*') ? 'bg-[#4a7fe5]/20 text-white' : 'text-white/55 hover:bg-white/[0.07] hover:text-white/90' }}">
      @if(request()->routeIs('vehicle.*'))
        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-[3px] h-5 bg-[#4a7fe5] rounded-r-[3px]"></span>
      @endif
      <svg class="w-4 h-4 flex-shrink-0 opacity-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="1" y="3" width="15" height="13" rx="2"/>
        <path d="M16 8h4l3 5v3h-7V8z"/>
        <circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
      </svg>
      Vehicles
    </a>

    <a href="{{ route('vehicle-log.index') }}" class="flex items-center gap-[11px] px-3 py-2.5 rounded-[9px] mb-0.5 text-[13.5px] font-medium transition-all duration-[180ms] no-underline relative {{ request()->routeIs('vehicle-log.*') ? 'bg-[#4a7fe5]/20 text-white' : 'text-white/55 hover:bg-white/[0.07] hover:text-white/90' }}">
      @if(request()->routeIs('vehicle-log.*'))
        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-[3px] h-5 bg-[#4a7fe5] rounded-r-[3px]"></span>
      @endif
      <svg class="w-4 h-4 flex-shrink-0 opacity-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
      </svg>
      Vehicle Logs
    </a>

    <div class="text-[10px] font-semibold text-white/30 tracking-[1.2px] uppercase px-2.5 mb-2 mt-5">System</div>
    <a href="#" class="flex items-center gap-[11px] px-3 py-2.5 rounded-[9px] mb-0.5 text-[13.5px] font-medium text-white/55 hover:bg-white/[0.07] hover:text-white/90 transition-all duration-[180ms] no-underline">
      <svg class="w-4 h-4 flex-shrink-0 opacity-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="3"/>
        <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/>
      </svg>
      Settings
    </a>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="flex items-center gap-[11px] px-3 py-2.5 rounded-[9px] mb-0.5 text-[13.5px] font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all duration-[180ms] w-full mt-1">
        <svg class="w-4 h-4 flex-shrink-0 opacity-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
        Logout
      </button>
    </form>
  </nav>

  <div class="px-3.5 py-4 border-t border-white/[0.08]">
    <div class="flex items-center gap-2.5 px-3 py-2.5 rounded-[9px] cursor-pointer hover:bg-white/[0.07] transition-colors duration-[180ms]">
      <div class="w-[34px] h-[34px] rounded-[9px] bg-gradient-to-br from-[#4a7fe5] to-purple-600 flex items-center justify-center text-[13px] font-bold text-white flex-shrink-0">AD</div>
      <div class="flex-1 min-w-0">
        <div class="text-[13px] font-semibold text-white truncate">Admin</div>
        <div class="text-[11px] text-white/40">Super Admin</div>
      </div>
    </div>
  </div>
</aside>

<!-- MAIN -->
<div class="flex-1 flex flex-col">
  <header class="flex items-center justify-between px-8 py-5 bg-white border-b border-slate-200">
    <span class="text-lg font-bold text-[#0f2854]">@yield('page-title', 'Dashboard')</span>
    
  </header>

  <main class="flex-1 p-8">
    @yield('content')
  </main>
</div>

</body>
</html>
