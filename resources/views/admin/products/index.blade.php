@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">

<h1 class="text-2xl font-bold mb-4">Semua Produk</h1>

<table class="w-full border">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2">Foto</th>
            <th class="p-2">Nama</th>
            <th class="p-2">Seller</th>
            <th class="p-2">Harga</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $p)
            <tr>
                <td class="p-2">
                    <img src="{{ $p->images->first()->url ?? '' }}" class="w-16 h-16 object-cover">
                </td>
                <td class="p-2">{{ $p->title }}</td>
                <td class="p-2">{{ $p->seller->name }}</td>
                <td class="p-2">Rp {{ number_format($p->price,0,',','.') }}</td>
                <td class="p-2">
                    <form action="{{ route('products.destroy',$p->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Hapus</button>
                    </form>
                    <form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Tambah ke keranjang
    </button>
</form>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>

@endsection
