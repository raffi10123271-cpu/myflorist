@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- FOTO PRODUK -->
        <div>
            @if($product->images->count() > 0)
                <img src="{{ asset($product->images->first()->url) }}" 
                     class="w-full h-80 object-cover rounded-lg shadow">
            @else
                <div class="w-full h-80 bg-gray-200 flex items-center justify-center rounded">
                    <span class="text-gray-500">No Image</span>
                </div>
            @endif

            <div class="grid grid-cols-4 gap-2 mt-4">
                @foreach($product->images as $img)
                    <img src="{{ asset($img->url) }}" 
                         class="w-full h-20 object-cover rounded border">
                @endforeach
            </div>
        </div>

        <!-- DETAIL PRODUK -->
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $product->title }}</h1>

            <p class="text-green-600 text-2xl font-bold mb-4">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>

            <p class="text-gray-700 mb-6">
                {{ $product->description }}
            </p>

            <!-- FORM ADD TO CART -->
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <label class="block mb-2 text-gray-700 font-semibold">Jumlah</label>
                <input type="number" name="qty" value="1" min="1" 
                       class="border p-2 w-24 rounded">

                <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">
                    Tambah ke Keranjang
                </button>
            </form>
        </div>

    </div>

</div>

@endsection
