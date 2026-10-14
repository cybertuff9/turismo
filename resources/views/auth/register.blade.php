@extends('layouts.turismo')

@section('content')
<section class="grid lg:grid-cols-2 min-h-[calc(100vh-5rem)]">

    {{-- Panel kiri: branding --}}
    <div class="hidden lg:flex relative bg-neutral-950 text-white items-center justify-center overflow-hidden">
        <span class="absolute inset-0 flex items-center justify-center text-[14vw] font-black text-white/5 select-none whitespace-nowrap">
            TURISMO
        </span>
        <div class="relative px-16">
            <p class="text-red-600 font-bold tracking-[0.3em] text-sm">JOIN US</p>
            <h1 class="text-6xl font-black tracking-tight mt-3 leading-none">
                START YOUR<br>JOURNEY.
            </h1>
            <p class="text-neutral-400 mt-6 max-w-sm">
                Buat akun untuk menyimpan pilihan model dan mengelola keranjangmu.
            </p>
        </div>
    </div>

    {{-- Panel kanan: form --}}
    <div class="flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-md">
            <p class="text-red-600 font-bold tracking-[0.3em] text-sm">ACCOUNT</p>
            <h2 class="text-5xl font-black tracking-tight mt-1">REGISTER</h2>

            <form method="POST" action="{{ route('register') }}" class="mt-10">
                @csrf

                {{-- Nama --}}
                <div class="mb-6">
                    <label for="name" class="block text-xs font-bold tracking-widest mb-2">NAMA</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                           required autofocus autocomplete="name"
                           class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                    @error('name')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-6">
                    <label for="email" class="block text-xs font-bold tracking-widest mb-2">EMAIL</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autocomplete="username"
                           class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                    @error('email')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-6">
                    <label for="password" class="block text-xs font-bold tracking-widest mb-2">PASSWORD</label>
                    <input id="password" type="password" name="password"
                           required autocomplete="new-password"
                           class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                    <p class="text-xs text-neutral-500 mt-1">Minimal 8 karakter.</p>
                    @error('password')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi password --}}
                <div class="mb-8">
                    <label for="password_confirmation" class="block text-xs font-bold tracking-widest mb-2">KONFIRMASI PASSWORD</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           required autocomplete="new-password"
                           class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                    @error('password_confirmation')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-black text-white text-xs font-bold tracking-widest py-5 hover:bg-red-600 transition">
                    REGISTER
                </button>
            </form>

            <div class="mt-8 pt-8 border-t text-sm text-neutral-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold text-black underline hover:text-red-600">
                    Login di sini
                </a>
            </div>
        </div>
    </div>
</section>
@endsection