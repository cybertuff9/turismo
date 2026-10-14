@extends('layouts.turismo')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-16">
    <p class="text-red-600 font-bold tracking-[0.3em] text-sm">AKUN</p>
    <h1 class="text-4xl font-black mb-10">PESANAN SAYA</h1>

    <div class="overflow-x-auto border">
        <table class="w-full text-left">
            <thead class="bg-neutral-100 text-xs tracking-widest">
                <tr>
                    <th class="p-4">KODE</th>
                    <th class="p-4">TANGGAL</th>
                    <th class="p-4">ITEM</th>
                    <th class="p-4">TOTAL</th>
                    <th class="p-4">STATUS</th>
                    <th class="p-4">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $o)
                    <tr class="border-t">
                        <td class="p-4 font-bold">{{ $o->code }}</td>
                        <td class="p-4 text-sm">{{ $o->created_at->format('d M Y H:i') }}</td>
                        <td class="p-4 text-sm">{{ $o->items_count }}</td>
                        <td class="p-4">$ {{ number_format($o->total, 0, ',', '.') }}</td>
                        <td class="p-4 text-xs font-bold uppercase">{{ $o->status }}</td>
                        <td class="p-4">
                            <div class="flex gap-4 text-sm font-semibold">
                                <a href="{{ route('orders.show', $o) }}" class="text-blue-600">Detail</a>
                                <a href="{{ route('orders.print', $o) }}" target="_blank" class="text-red-600">Cetak</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-10 text-center text-neutral-500">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $orders->links() }}</div>
</div>
@endsection