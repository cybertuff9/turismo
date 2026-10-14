<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TURISMO | The Collection</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,800,900" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-neutral-900">

<header class="sticky top-0 z-50 bg-white border-b" x-data="{ menu: false }">
    <div class="max-w-7xl mx-auto px-6 h-20 grid grid-cols-3 items-center">

        {{-- Kiri: tombol menu --}}
        <button @click="menu = true" class="flex items-center gap-3 text-sm font-bold tracking-widest">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            MENU
        </button>

        {{-- Tengah: logo --}}
        <a href="{{ route('home') }}" class="text-center text-2xl font-black tracking-[0.3em]">
            TURISMO
        </a>

        {{-- Kanan: user, keranjang, login/logout --}}
        <div class="flex items-center justify-end gap-5">

            @auth
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-2 text-sm font-bold hover:text-red-600">
                    <span class="w-10 h-10 rounded-full bg-black text-white flex items-center justify-center">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                    <span class="hidden sm:inline">{{ strtoupper(auth()->user()->name) }}</span>
                </a>
            @endauth

            {{-- Keranjang --}}
            <a href="{{ route('cart.index') }}" class="relative" aria-label="Keranjang">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 7h12l1 13H5L6 7zM9 7a3 3 0 016 0"/>
                </svg>
                @if(count(session('cart', [])) > 0)
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">
                        {{ count(session('cart', [])) }}
                    </span>
                @endif
            </a>

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-black text-white text-xs font-bold tracking-widest px-5 py-3 hover:bg-red-600 transition">
                        LOGOUT
                    </button>
                </form>
            @else
                <a href="{{ route('register') }}" class="hidden sm:inline text-xs font-bold tracking-widest hover:text-red-600">
                    REGISTER
                </a>
                <a href="{{ route('login') }}"
                   class="bg-black text-white text-xs font-bold tracking-widest px-5 py-3 hover:bg-red-600 transition">
                    LOGIN
                </a>
            @endauth
        </div>
    </div>

    {{-- Sidebar menu --}}
    <div x-show="menu" x-cloak class="fixed inset-0 z-50 flex"
         @keydown.escape.window="menu = false">
        <div class="w-80 max-w-[85%] bg-white h-full p-8 shadow-2xl overflow-y-auto">
            <button @click="menu = false" class="mb-10 text-sm font-bold tracking-widest">✕ TUTUP</button>

            <nav class="flex flex-col gap-6 text-lg font-black">
                <a href="{{ route('home') }}" @click="menu = false">HOME</a>
                <a href="{{ route('home') }}#inventory" @click="menu = false">COLLECTION</a>
                <a href="{{ route('cart.index') }}">KERANJANG</a>

                @auth
                    <a href="{{ route('profile.edit') }}">PROFIL</a>
                    <a href="{{ route('orders.index') }}">PESANAN SAYA</a>

                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.products.index') }}" class="text-red-600">ADMIN PANEL</a>
                    @endif
                @else
                    <a href="{{ route('login') }}">LOGIN</a>
                    <a href="{{ route('register') }}">REGISTER</a>
                @endauth
            </nav>
        </div>

        <div class="flex-1 bg-black/50" @click="menu = false"></div>
    </div>
</header>

{{-- Pesan flash --}}
@if(session('success'))
    <div class="bg-green-100 text-green-800 text-sm text-center py-3">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 text-red-800 text-sm text-center py-3">
        {{ session('error') }}
    </div>
@endif

<main>
    @yield('content')
</main>

<footer class="border-t mt-24 py-10 text-center text-xs tracking-widest text-neutral-500">
    © {{ date('Y') }} TURISMO. ALL RIGHTS RESERVED.
</footer>

</body>
</html>