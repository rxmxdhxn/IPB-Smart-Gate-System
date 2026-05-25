<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Login - IPB Smart Gate System</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-['Plus_Jakarta_Sans'] min-h-screen flex items-center justify-center bg-slate-50">

  {{-- Background decoration --}}
  <div class="fixed inset-0 overflow-hidden pointer-events-none">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-[#4a7fe5]/5 rounded-full"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-[#0f2854]/5 rounded-full"></div>
  </div>

  <div class="relative w-full max-w-md mx-4">
    {{-- Logo / Brand --}}
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center w-14 h-14 bg-[#0f2854] rounded-2xl mb-4">
        <svg class="w-7 h-7 fill-none stroke-white stroke-[2]" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><line x1="12" y1="4" x2="12" y2="20"/><line x1="3" y1="12" x2="21" y2="12"/><path d="M7 8h2M15 8h2M7 16h2M15 16h2"/></svg>
      </div>
      <h1 class="text-2xl font-bold text-[#0f2854]">IPB Smart Gate</h1>
      <p class="text-sm text-slate-500 mt-1">Masuk ke akun Anda</p>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">

      {{-- Session Status --}}
      @if(session('status'))
      <div class="mb-5 bg-emerald-50 border border-emerald-200 rounded-xl p-3 text-sm text-emerald-700">
        {{ session('status') }}
      </div>
      @endif

      {{-- Error Messages --}}
      @if($errors->any())
      <div class="mb-5 bg-red-50 border border-red-200 rounded-xl p-3">
        <ul class="text-sm text-red-600 space-y-1">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-4">
          <label for="email" class="block text-[13px] font-semibold text-slate-700 mb-1.5">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                 placeholder="email@example.com"
                 class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
        </div>

        {{-- Password --}}
        <div class="mb-4">
          <label for="password" class="block text-[13px] font-semibold text-slate-700 mb-1.5">Password</label>
          <input type="password" id="password" name="password" required autocomplete="current-password"
                 placeholder="Masukkan password"
                 class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#4a7fe5]/30 focus:border-[#4a7fe5] transition-colors">
        </div>

        {{-- Remember + Forgot --}}
        <div class="flex items-center justify-between mb-6">
          <label for="remember_me" class="inline-flex items-center cursor-pointer">
            <input id="remember_me" type="checkbox" name="remember"
                   class="w-4 h-4 rounded border-slate-300 text-[#4a7fe5] focus:ring-[#4a7fe5]/30">
            <span class="ml-2 text-[13px] text-slate-600">Ingat saya</span>
          </label>

          @if(Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="text-[13px] font-medium text-[#4a7fe5] hover:text-[#3a6fd5] no-underline">
            Lupa password?
          </a>
          @endif
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full py-2.5 bg-[#0f2854] hover:bg-[#1a3a6e] text-white text-sm font-semibold rounded-lg transition-colors shadow-md shadow-[#0f2854]/20">
          Masuk
        </button>
      </form>

      {{-- Register link --}}
      @if(Route::has('register'))
      <p class="text-center text-[13px] text-slate-500 mt-5">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold text-[#4a7fe5] hover:text-[#3a6fd5] no-underline">Daftar</a>
      </p>
      @endif
    </div>

    {{-- Footer --}}
    <p class="text-center text-[11px] text-slate-400 mt-6">&copy; {{ date('Y') }} IPB Smart Gate System. All rights reserved.</p>
  </div>

</body>
</html>
