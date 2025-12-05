@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">

    <h2 class="text-2xl font-bold mb-4">Riwayat Pesanan</h2>

    @if ($orders->count() == 0)
        <div class="bg-white p-6 rounded shadow text-center">
            <p class="text-gray-600">Belum ada pesanan.</p>
        </div>
    @endif

    @foreach ($orders as $order)
        <div class="bg-white p-4 shadow rounded mb-4 border">
            <div class="flex justify-between">
                <div>
                    <h3 class="font-bold text-lg">Order #{{ $order->id }}</h3>
                    <p class="text-gray-600 text-sm">
                        Status: <span class="font-semibold text-green-600">{{ ucfirst($order->status) }}</span>
                    </p>
                    <p class="text-gray-600 text-sm">
                        Tanggal: {{ $order->created_at->format('d M Y') }}
                    </p>
                </div>

                <div class="text-right">
                    <p class="font-bold">
                        Total: Rp{{ number_format($order->total, 0, ',', '.') }}
                    </p>
                    <a href="{{ route('orders.show', $order->id) }}"
                       class="text-green-600 font-semibold">
                        Lihat Detail →
                    </a>
                </div>
            </div>
        </div>
    @endforeach

</div>
@endsection
