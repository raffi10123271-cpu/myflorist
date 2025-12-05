@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">

    <h2 class="text-2xl font-bold mb-4">Detail Pesanan #{{ $order->id }}</h2>

    <div class="bg-white p-6 rounded shadow mb-6">

        <p class="text-gray-600">
            Status:
            <span class="font-semibold text-green-600">{{ ucfirst($order->status) }}</span>
        </p>

        <p class="text-gray-700 mt-2">
            Total: <span class="font-bold">Rp{{ number_format($order->total) }}</span>
        </p>

        <hr class="my-4">

        <h3 class="font-bold mb-2">Produk</h3>

        @foreach ($order->items as $item)
            <div class="flex justify-between border-b py-2">
                <div>
                    <p class="font-semibold">{{ $item->product_name }}</p>
                    <p class="text-sm text-gray-600">x{{ $item->qty }}</p>
                </div>
                <p class="font-bold">Rp{{ number_format($item->price) }}</p>
            </div>
        @endforeach

        <a href="/orders" class="text-green-600 mt-4 inline-block">← Kembali</a>
        
        @php
    $seller = $order->items->first()->product->seller;
    @endphp

    <a href="https://wa.me/{{ $seller->whatsapp }}?text=Halo%20saya%20ingin%20bertanya%20tentang%20pesanan%20ID%20{{ $order->id }}"
        target="_blank"
        class="bg-green-600 text-white px-4 py-2 rounded-full font-semibold flex items-center gap-2 w-max">
        <i class="fa-brands fa-whatsapp text-xl"></i>
        Chat Seller
    </a>

    <a href="{{ route('chat', $order->id) }}"
        class="bg-green-600 text-white px-4 py-2 rounded-full font-semibold">
        Chat Seller
    </a>
    </div>
</div>
@endsection
