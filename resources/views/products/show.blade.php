@extends('layouts.turismo')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-12">
    <div class="bg-neutral-100 flex items-center justify-center p-10">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="max-h-96 object-contain">
        @else
            <span class="text-neutral-400">NO IMAGE</span>
        @endif
    </div>

    <div>
        <span class="inline-block border border-black text-[10px] font-bold px-2 py-1">
            SEGMENT: {{ strtoupper($product->segment) }}
        </span>
        <h1 class="text-5xl font-black uppercase mt-4">{{ $product->name }}</h1>
        <p class="text-neutral-600 mt-4">{{ $product->description }}</p>

        <p class="text-[10px] text-neutral-500 mt-8">FROM</p>
        <p class="text-3xl font-black">$ {{ number_format($product->price, 0, ',', '.') }}</p>

        <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-8">
            @csrf
            <button class="w-full bg-black text-white text-xs font-bold tracking-widest py-5 hover:bg-red-600 transition">
                ADD TO CART
            </button>
        </form>

        <a href="{{ route('home') }}#inventory" class="inline-block mt-6 text-sm text-neutral-500">← Kembali ke koleksi</a>
    </div>
</div>
@endsection