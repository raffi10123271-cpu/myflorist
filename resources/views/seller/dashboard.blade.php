@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Dashboard Seller</h1>

    <div class="grid grid-cols-2 gap-4">
        <div class="p-4 bg-white rounded shadow">
            <h2 class="text-xl font-bold">Total Produk</h2>
            <p class="text-3xl">{{ $productCount }}</p>
        </div>

        <div class="p-4 bg-white rounded shadow">
            <h2 class="text-xl font-bold">Total Stok</h2>
            <p class="text-3xl">{{ $totalStock }}</p>
        </div>
    </div>
</div>

@endsection
