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

    <div class="grid grid-cols-3 md:grid-cols-5 lg:grid-cols-7 gap-5">

        @foreach($categories as $cat)
        <div class="flex flex-col items-center bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition cursor-pointer">

            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-2">
                <i class="fa-solid fa-seedling text-green-600 text-2xl"></i>
            </div>

            <span class="text-sm font-semibold text-center">{{ $cat->name }}</span>
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
