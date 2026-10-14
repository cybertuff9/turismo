@extends('layouts.turismo')

@section('content')
<section class="grid lg:grid-cols-2 min-h-[calc(100vh-5rem)]">

    {{-- Panel kiri: branding --}}
    <div class="hidden lg:flex relative bg-neutral-950 text-white items-center justify-center overflow-hidden">
        <span class="absolute inset-0 flex items-center justify-center text-[14vw] font-black text-white/5 select-none whitespace-nowrap">
            TURISMO
        </span>
        <div class="relative px-16">
            <p class="text-red-600 font-bold tracking-[0.3em] text-sm">WELCOME BACK</p>
            <h1 class="text-6xl font-black tracking-tight mt-3 leading-none">
                DRIVE YOUR<br>DREAM.
            </h1>
            <p class="text-neutral-400 mt-6 max-w-sm">
                Masuk untuk menjelajahi koleksi SUV, Sportcar, dan Sedan terbaik kami.
            </p>
        </div>
    </div>

    {{-- Panel kanan: form --}}
    <div class="flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-md">
            <p class="text-red-600 font-bold tracking-[0.3em] text-sm">ACCOUNT</p>
            <h2 class="text-5xl font-black tracking-tight mt-1">LOGIN</h2>

            @if (session('status'))
                <div class="mt-6 bg-green-100 text-green-800 text-sm px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="mt-10">
                @csrf

                {{-- Email --}}
                <div class="mb-6">
                    <label for="email" class="block text-xs font-bold tracking-widest mb-2">EMAIL</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autofocus autocomplete="username"
                           class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                    @error('email')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-6">
                    <label for="password" class="block text-xs font-bold tracking-widest mb-2">PASSWORD</label>
                    <input id="password" type="password" name="password"
                           required autocomplete="current-password"
                           class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                    @error('password')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember + lupa password --}}
                <div class="flex items-center justify-between mb-8">
                    <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-neutral-600">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="border-neutral-800 text-black focus:ring-0">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-neutral-500 underline hover:text-black">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <button type="submit"
                        class="w-full bg-black text-white text-xs font-bold tracking-widest py-5 hover:bg-red-600 transition">
                    LOG IN
                </button>
            </form>

            {{-- Tautan register --}}
            <div class="mt-8 pt-8 border-t text-sm text-neutral-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold text-black underline hover:text-red-600">
                    Daftar sekarang
                </a>
            </div>
        </div>
    </div>
</section>
@endsection