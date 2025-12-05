@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-bold">Total User</h2>
            <p class="text-3xl">{{ $userCount }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-bold">Total Produk</h2>
            <p class="text-3xl">{{ $productCount }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-bold">Total Order</h2>
            <p class="text-3xl">{{ $orderCount }}</p>
        </div>
    </div>

</div>

@endsection
