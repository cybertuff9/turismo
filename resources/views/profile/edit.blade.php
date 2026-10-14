@extends('layouts.turismo')

@section('content')
@php
    $recentOrders = $user->orders()->latest()->take(5)->get();
    $orderCount   = $user->orders()->count();
    $orderTotal   = $user->orders()->sum('total');

    // Tab yang terbuka saat halaman dimuat
    $startTab = 'akun';
    if ($errors->updatePassword->any() || session('status') === 'password-updated') {
        $startTab = 'password';
    } elseif ($errors->userDeletion->any()) {
        $startTab = 'hapus';
    }
@endphp

{{-- HEADER GELAP --}}
<section class="relative bg-neutral-950 text-white overflow-hidden">
    <span class="absolute inset-0 flex items-center justify-center text-[16vw] font-black text-white/5 select-none whitespace-nowrap">
        PROFILE
    </span>

    <div class="relative max-w-6xl mx-auto px-6 py-16 flex flex-col sm:flex-row sm:items-center gap-6">
        <span class="w-24 h-24 rounded-full bg-white text-black text-4xl font-black flex items-center justify-center shrink-0">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </span>

        <div>
            <p class="text-red-600 font-bold tracking-[0.3em] text-sm">PROFIL</p>
            <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tight">{{ $user->name }}</h1>
            <p class="text-neutral-400 text-sm mt-2">
                {{ $user->email }}
                @if($user->is_admin)
                    <span class="ml-2 border border-red-600 text-red-600 text-[10px] font-bold px-2 py-1 tracking-widest">ADMIN</span>
                @endif
            </p>
        </div>
    </div>
</section>

<div class="max-w-6xl mx-auto px-6 py-12" x-data="{ tab: '{{ $startTab }}' }">

    {{-- KARTU STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 -mt-24 relative mb-12">
        <div class="bg-white border p-6">
            <p class="text-[10px] font-bold tracking-widest text-neutral-500">TOTAL PESANAN</p>
            <p class="text-3xl font-black mt-1">{{ $orderCount }}</p>
        </div>
        <div class="bg-white border p-6">
            <p class="text-[10px] font-bold tracking-widest text-neutral-500">TOTAL BELANJA</p>
            <p class="text-3xl font-black mt-1">$ {{ number_format($orderTotal, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white border p-6">
            <p class="text-[10px] font-bold tracking-widest text-neutral-500">BERGABUNG</p>
            <p class="text-3xl font-black mt-1">{{ $user->created_at->format('d M Y') }}</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-[260px_1fr] gap-10">

        {{-- MENU TAB --}}
        <aside>
            <nav class="flex lg:flex-col gap-2 overflow-x-auto text-xs font-bold tracking-widest">
                <button type="button" @click="tab = 'akun'"
                        :class="tab === 'akun' ? 'bg-black text-white' : 'border hover:border-black'"
                        class="px-5 py-4 text-left whitespace-nowrap transition">
                    INFORMASI AKUN
                </button>
                <button type="button" @click="tab = 'password'"
                        :class="tab === 'password' ? 'bg-black text-white' : 'border hover:border-black'"
                        class="px-5 py-4 text-left whitespace-nowrap transition">
                    GANTI PASSWORD
                </button>
                <button type="button" @click="tab = 'pesanan'"
                        :class="tab === 'pesanan' ? 'bg-black text-white' : 'border hover:border-black'"
                        class="px-5 py-4 text-left whitespace-nowrap transition">
                    PESANAN TERBARU
                </button>
                <button type="button" @click="tab = 'hapus'"
                        :class="tab === 'hapus' ? 'bg-red-600 text-white' : 'border border-red-200 text-red-600 hover:border-red-600'"
                        class="px-5 py-4 text-left whitespace-nowrap transition">
                    HAPUS AKUN
                </button>
            </nav>
        </aside>

        {{-- ISI TAB --}}
        <div class="min-w-0">

            {{-- TAB: INFORMASI AKUN --}}
            <section x-show="tab === 'akun'" x-cloak>
                <h2 class="text-2xl font-black mb-6">INFORMASI AKUN</h2>

                @if(session('status') === 'profile-updated')
                    <div class="bg-green-100 text-green-800 text-sm px-4 py-3 mb-6">Profil berhasil diperbarui.</div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" class="max-w-xl">
                    @csrf
                    @method('PATCH')

                    <div class="mb-5">
                        <label for="name" class="block text-xs font-bold tracking-widest mb-2">NAMA</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required
                               autocomplete="name"
                               class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-8">
                        <label for="email" class="block text-xs font-bold tracking-widest mb-2">EMAIL</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required
                               autocomplete="username"
                               class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                        @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button class="bg-black text-white text-xs font-bold tracking-widest px-8 py-4 hover:bg-red-600 transition">
                        SIMPAN PERUBAHAN
                    </button>
                </form>
            </section>

            {{-- TAB: GANTI PASSWORD --}}
            <section x-show="tab === 'password'" x-cloak>
                <h2 class="text-2xl font-black mb-6">GANTI PASSWORD</h2>

                @if(session('status') === 'password-updated')
                    <div class="bg-green-100 text-green-800 text-sm px-4 py-3 mb-6">Password berhasil diganti.</div>
                @endif

                <form method="POST" action="{{ route('password.update') }}" class="max-w-xl">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="current_password" class="block text-xs font-bold tracking-widest mb-2">PASSWORD SAAT INI</label>
                        <input id="current_password" type="password" name="current_password"
                               autocomplete="current-password"
                               class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                        @if($errors->updatePassword->has('current_password'))
                            <p class="text-red-600 text-sm mt-1">{{ $errors->updatePassword->first('current_password') }}</p>
                        @endif
                    </div>

                    <div class="mb-5">
                        <label for="new_password" class="block text-xs font-bold tracking-widest mb-2">PASSWORD BARU</label>
                        <input id="new_password" type="password" name="password" autocomplete="new-password"
                               class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                        <p class="text-xs text-neutral-500 mt-1">Minimal 8 karakter.</p>
                        @if($errors->updatePassword->has('password'))
                            <p class="text-red-600 text-sm mt-1">{{ $errors->updatePassword->first('password') }}</p>
                        @endif
                    </div>

                    <div class="mb-8">
                        <label for="password_confirmation" class="block text-xs font-bold tracking-widest mb-2">KONFIRMASI PASSWORD BARU</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               autocomplete="new-password"
                               class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                        @if($errors->updatePassword->has('password_confirmation'))
                            <p class="text-red-600 text-sm mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                        @endif
                    </div>

                    <button class="bg-black text-white text-xs font-bold tracking-widest px-8 py-4 hover:bg-red-600 transition">
                        GANTI PASSWORD
                    </button>
                </form>
            </section>

            {{-- TAB: PESANAN TERBARU --}}
            <section x-show="tab === 'pesanan'" x-cloak>
                <div class="flex justify-between items-end mb-6">
                    <h2 class="text-2xl font-black">PESANAN TERBARU</h2>
                    <a href="{{ route('orders.index') }}" class="text-sm text-neutral-500 underline hover:text-black">
                        Lihat semua
                    </a>
                </div>

                @forelse($recentOrders as $o)
                    <div class="border p-5 mb-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <p class="font-bold">{{ $o->code }}</p>
                            <p class="text-xs text-neutral-500">{{ $o->created_at->format('d M Y H:i') }}</p>
                            <span class="inline-block border border-black text-[10px] font-bold px-2 py-1 mt-2 uppercase">
                                {{ $o->status }}
                            </span>
                        </div>

                        <div class="sm:text-right">
                            <p class="text-xl font-black">$ {{ number_format($o->total, 0, ',', '.') }}</p>
                            <div class="flex sm:justify-end gap-4 mt-2 text-sm font-semibold">
                                <a href="{{ route('orders.show', $o) }}" class="text-blue-600">Detail</a>
                                <a href="{{ route('orders.print', $o) }}" target="_blank" class="text-red-600">Cetak struk</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="border border-dashed p-10 text-center">
                        <p class="text-neutral-500 mb-4">Kamu belum punya pesanan.</p>
                        <a href="{{ route('home') }}#inventory"
                           class="inline-block bg-black text-white text-xs font-bold tracking-widest px-8 py-4 hover:bg-red-600 transition">
                            LIHAT KOLEKSI
                        </a>
                    </div>
                @endforelse
            </section>

            {{-- TAB: HAPUS AKUN --}}
            <section x-show="tab === 'hapus'" x-cloak>
                <h2 class="text-2xl font-black mb-2 text-red-600">HAPUS AKUN</h2>
                <p class="text-sm text-neutral-600 mb-8 max-w-xl">
                    Akun beserta seluruh riwayat pesanan akan dihapus permanen dan tidak bisa dikembalikan.
                </p>

                <form method="POST" action="{{ route('profile.destroy') }}" class="max-w-xl"
                      onsubmit="return confirm('Yakin ingin menghapus akun? Tindakan ini tidak bisa dibatalkan.')">
                    @csrf
                    @method('DELETE')

                    <div class="mb-6">
                        <label for="delete_password" class="block text-xs font-bold tracking-widest mb-2">KONFIRMASI DENGAN PASSWORD</label>
                        <input id="delete_password" type="password" name="password" autocomplete="current-password"
                               class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                        @if($errors->userDeletion->has('password'))
                            <p class="text-red-600 text-sm mt-1">{{ $errors->userDeletion->first('password') }}</p>
                        @endif
                    </div>

                    <button class="bg-red-600 text-white text-xs font-bold tracking-widest px-8 py-4 hover:bg-black transition">
                        HAPUS AKUN SAYA
                    </button>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection