@extends('layouts.turismo')

@section('content')

@php
    $series = [
        ['key' => 'suv',      'title' => 'SUV SERIES',      'img' => 'img/hero/macan.png'],
        ['key' => 'sportcar', 'title' => 'SPORTCAR SERIES', 'img' => 'img/hero/gt3-rs.png'],
        ['key' => 'sedan',    'title' => 'SEDAN SERIES',    'img' => 'img/hero/sedan.png'],
    ];
@endphp

{{-- HERO SLIDER --}}
<section class="bg-neutral-950 text-white overflow-hidden">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
            @foreach($series as $s)
                <div class="swiper-slide">
                    <div class="relative h-[calc(100vh-5rem)] min-h-[560px] flex flex-col items-center justify-center">
                        <span class="absolute inset-0 flex items-center justify-center text-[18vw] font-black whitespace-nowrap text-white/5 select-none">
                            {{ $s['title'] }}
                        </span>

                        <h1 class="relative text-5xl md:text-7xl font-black tracking-tight">{{ $s['title'] }}</h1>

                        <img src="{{ asset($s['img']) }}" alt="{{ $s['title'] }}"
                             class="relative w-[640px] max-w-[80%] my-6">

                        <a href="#inventory" data-explore="{{ $s['key'] }}"
                           class="relative bg-black border border-white/20 px-10 py-4 text-xs font-bold tracking-widest hover:bg-white hover:text-black transition">
                            EXPLORE COLLECTIONS
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>

{{-- INVENTORY --}}
<section id="inventory" class="max-w-7xl mx-auto px-6 pt-24">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
        <div>
            <p class="text-red-600 font-bold tracking-[0.3em] text-sm">INVENTORY</p>
            <h2 class="text-5xl md:text-6xl font-black tracking-tight">THE COLLECTION</h2>
        </div>
        <input id="search" type="text" placeholder="SEARCH MODELS..."
               class="w-full md:w-96 border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
    </div>

    {{-- Tab kategori --}}
    <div id="tabs" class="flex gap-8 mt-12 border-b overflow-x-auto">
        @foreach(['all' => 'ALL MODELS', 'suv' => 'SUV SERIES', 'sportcar' => 'SPORTCAR SERIES', 'sedan' => 'SEDAN SERIES'] as $key => $label)
            <button data-filter="{{ $key }}"
                    class="tab pb-4 text-xs font-bold tracking-widest whitespace-nowrap border-b-2 border-transparent text-neutral-500">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Grid produk --}}
    <div id="grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-12 items-stretch">
        @foreach($products as $p)
            <div class="card flex flex-col h-full" data-segment="{{ $p->segment }}" data-name="{{ strtolower($p->name) }}">
                <span class="self-start inline-block border border-black text-[10px] font-bold px-2 py-1 mb-4">
                    SEGMENT: {{ strtoupper($p->segment) }}
                </span>

                <a href="{{ route('products.show', $p) }}"
                   class="bg-neutral-100 aspect-[4/3] flex items-center justify-center p-8 shrink-0">
                    @if($p->image)
                        <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}"
                             class="max-h-full max-w-full object-contain">
                    @else
                        <span class="text-neutral-400 text-sm">NO IMAGE</span>
                    @endif
                </a>

                {{-- Info: flex-1 mengisi sisa tinggi, tombol terdorong ke dasar card --}}
                <div class="flex flex-1 justify-between items-start gap-4 mt-6">
                    <div class="min-w-0">
                        <h3 class="text-2xl font-black uppercase leading-tight min-h-[3.25rem] line-clamp-2">{{ $p->name }}</h3>
                        <p class="text-neutral-500 text-sm mt-1 min-h-[2.5rem] line-clamp-2">{{ $p->description }}</p>
                    </div>
                    <div class="text-right shrink-0">
                        <p class="text-[10px] text-neutral-500">FROM</p>
                        <p class="text-lg font-black whitespace-nowrap">$ {{ number_format($p->price, 0, ',', '.') }}</p>
                    </div>
                </div>

                <a href="{{ route('products.show', $p) }}"
                   class="block text-center bg-black text-white text-xs font-bold tracking-widest py-5 mt-6 hover:bg-red-600 transition">
                    SELECT MODEL
                </a>
            </div>
        @endforeach
    </div>

    <p id="empty" class="hidden text-center text-neutral-500 py-20">Model tidak ditemukan.</p>
</section>

@endsection
