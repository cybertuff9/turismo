@extends('layouts.turismo')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-black">KELOLA PRODUK</h1>
        <a href="{{ route('admin.products.create') }}"
           class="bg-black text-white text-xs font-bold tracking-widest px-6 py-3 hover:bg-red-600 transition">
            + TAMBAH PRODUK
        </a>
    </div>

    <div class="overflow-x-auto border">
        <table class="w-full text-left">
            <thead class="bg-neutral-100 text-xs tracking-widest">
                <tr>
                    <th class="p-4">GAMBAR</th>
                    <th class="p-4">NAMA</th>
                    <th class="p-4">SEGMEN</th>
                    <th class="p-4">HARGA</th>
                    <th class="p-4">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                    <tr class="border-t">
                        <td class="p-4">
                            @if($p->image)
                                <img src="{{ asset('storage/' . $p->image) }}"
                                     alt="{{ $p->name }}" class="w-24 h-16 object-cover">
                            @else
                                <div class="w-24 h-16 bg-neutral-100 flex items-center justify-center text-[10px] text-neutral-400">
                                    NO IMAGE
                                </div>
                            @endif
                        </td>
                        <td class="p-4 font-bold uppercase">{{ $p->name }}</td>
                        <td class="p-4 uppercase text-sm">{{ $p->segment }}</td>
                        <td class="p-4">$ {{ number_format($p->price, 0, ',', '.') }}</td>
                        <td class="p-4">
                            <div class="flex items-center gap-4">
                                <a href="{{ route('admin.products.edit', $p) }}"
                                   class="text-blue-600 font-semibold text-sm">Edit</a>

                                <form action="{{ route('admin.products.destroy', $p) }}" method="POST"
                                      onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 font-semibold text-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-10 text-center text-neutral-500">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection