@extends('layouts.app')

@section('content')



<!-- LOCATION BAR -->
<div class="max-w-7xl mx-auto px-4 py-3 flex items-center text-gray-600">
    <i class="fa-solid fa-location-dot mr-2"></i>
    Dikirim ke <span class="font-semibold ml-1">Rumah MUHAMMAD RAFFI MURSHALAT</span>
</div>



<!-- SLIDER BANNER -->
@include('components.home-slider')



<!-- KATEGORI PILIHAN -->
<div class="max-w-7xl mx-auto px-4 mt-6">
    <h2 class="text-lg font-bold mb-4">Kategori Pilihan</h2>

    <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4">

        @foreach($categories as $cat)
        <div class="flex flex-col items-center bg-white rounded-lg shadow p-3 hover:shadow-md transition cursor-pointer">
            <img src="https://via.placeholder.com/60" class="rounded-full mb-2" />
            <span class="text-sm font-semibold">{{ $cat->name }}</span>
        </div>
        @endforeach

    </div>
</div>

<!-- PRODUK TERLARIS -->
<div class="max-w-7xl mx-auto px-4 mt-10 mb-16">
    <h2 class="text-lg font-bold mb-4">Produk Terlaris</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-5">

        @foreach($products as $p)
        <div class="rounded-lg shadow hover:shadow-xl transition bg-white cursor-pointer">
            <img src="{{ $p->images->first()->image_url ?? 'https://via.placeholder.com/200' }}"
                 class="w-full h-40 object-cover rounded-t-lg">

            <div class="p-3">
                <div class="font-semibold text-sm">{{ $p->name }}</div>
                <div class="text-green-600 font-bold mt-1">Rp {{ number_format($p->price) }}</div>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection
