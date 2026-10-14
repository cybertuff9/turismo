@extends('layouts.turismo')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-16">
    <p class="text-red-600 font-bold tracking-[0.3em] text-sm">DETAIL PESANAN</p>
    <h1 class="text-4xl font-black">{{ $order->code }}</h1>
    <p class="text-sm text-neutral-500 mt-1">{{ $order->created_at->format('d M Y H:i') }}</p>

    <div class="grid sm:grid-cols-2 gap-8 mt-10 text-sm">
        <div>
            <p class="text-xs font-bold tracking-widest text-neutral-500 mb-2">PEMBELI</p>
            <p class="font-bold">{{ $order->customer_name }}</p>
            <p>{{ $order->phone }}</p>
            <p class="text-neutral-600">{{ $order->address }}</p>
        </div>
        <div>
            <p class="text-xs font-bold tracking-widest text-neutral-500 mb-2">STATUS</p>
            <span class="inline-block border border-black text-[10px] font-bold px-2 py-1 uppercase">
                {{ $order->status }}
            </span>
        </div>
    </div>

    <table class="w-full text-left mt-10 border">
        <thead class="bg-neutral-100 text-xs tracking-widest">
            <tr>
                <th class="p-4">MODEL</th>
                <th class="p-4 text-right">HARGA</th>
                <th class="p-4 text-right">QTY</th>
                <th class="p-4 text-right">SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr class="border-t">
                    <td class="p-4 font-bold uppercase">{{ $item->product_name }}</td>
                    <td class="p-4 text-right">$ {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="p-4 text-right">{{ $item->quantity }}</td>
                    <td class="p-4 text-right">$ {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="border-t bg-neutral-50">
                <td colspan="3" class="p-4 text-right font-black">TOTAL</td>
                <td class="p-4 text-right font-black">$ {{ number_format($order->total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="flex items-center gap-4 mt-10">
        <a href="{{ route('orders.print', $order) }}" target="_blank"
           class="bg-black text-white text-xs font-bold tracking-widest px-8 py-4 hover:bg-red-600 transition">
            CETAK STRUK
        </a>
        <a href="{{ route('orders.index') }}" class="text-sm text-neutral-500">← Semua pesanan</a>
    </div>
</div>
@endsection