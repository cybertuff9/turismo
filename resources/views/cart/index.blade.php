@extends('layouts.turismo')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-black mb-10">KERANJANG</h1>

    @forelse($products as $p)
        <div class="flex items-center gap-6 border-b py-6">
            <div class="w-28 h-20 bg-neutral-100 flex items-center justify-center">
                @if($p->image)
                    <img src="{{ asset('storage/' . $p->image) }}" class="max-h-full object-contain" alt="{{ $p->name }}">
                @endif
            </div>

            <div class="flex-1">
                <p class="font-black uppercase">{{ $p->name }}</p>
                <p class="text-sm text-neutral-500">Jumlah: {{ $cart[$p->id] }}</p>
            </div>

            <p class="font-bold">$ {{ number_format($p->price * $cart[$p->id], 0, ',', '.') }}</p>

            <form action="{{ route('cart.remove', $p) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="text-red-600 text-sm font-semibold">Hapus</button>
            </form>
        </div>
    @empty
        <p class="text-neutral-500">Keranjang masih kosong.</p>
    @endforelse

    @if($products->count())
        <div class="flex justify-between items-center mt-8 mb-12">
            <p class="text-xl font-black">TOTAL</p>
            <p class="text-xl font-black">$ {{ number_format($total, 0, ',', '.') }}</p>
        </div>

        @auth
            <div class="border-t pt-10">
                <p class="text-red-600 font-bold tracking-[0.3em] text-sm">CHECKOUT</p>
                <h2 class="text-3xl font-black mb-8">DATA PEMBELI</h2>

                <form action="{{ route('checkout') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-xs font-bold tracking-widest mb-2">NAMA LENGKAP</label>
                        <input type="text" name="customer_name"
                               value="{{ old('customer_name', auth()->user()->name) }}"
                               class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                        @error('customer_name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-xs font-bold tracking-widest mb-2">NOMOR TELEPON</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
                        @error('phone') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-xs font-bold tracking-widest mb-2">ALAMAT</label>
                        <textarea name="address" rows="3"
                                  class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">{{ old('address') }}</textarea>
                        @error('address') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button class="w-full bg-black text-white text-xs font-bold tracking-widest py-5 hover:bg-red-600 transition">
                        BUAT PESANAN
                    </button>
                </form>
            </div>
        @else
            <div class="border-t pt-10 text-center">
                <p class="text-neutral-600 mb-4">Login dulu untuk melanjutkan checkout.</p>
                <a href="{{ route('login') }}"
                   class="inline-block bg-black text-white text-xs font-bold tracking-widest px-10 py-4 hover:bg-red-600 transition">
                    LOGIN
                </a>
            </div>
        @endauth
    @endif

    <a href="{{ route('home') }}#inventory" class="inline-block mt-10 text-sm text-neutral-500">← Lanjut belanja</a>
</div>
@endsection