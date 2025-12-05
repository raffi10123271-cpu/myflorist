@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-4">Produk Saya</h1>

    <a href="{{ route('products.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">
        Tambah Produk
    </a>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Foto</th>
                <th class="p-2">Nama</th>
                <th class="p-2">Harga</th>
                <th class="p-2">Stok</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
                <tr>
                    <td class="p-2">
                        <img src="{{ $p->images->first()->url ?? '' }}" class="w-16 h-16 object-cover rounded">
                    </td>
                    <td class="p-2">{{ $p->title }}</td>
                    <td class="p-2">Rp {{ number_format($p->price,0,',','.') }}</td>
                    <td class="p-2">{{ $p->stock }}</td>
                    <td class="p-2">
                        <a href="{{ route('products.edit', $p->id) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 ml-2">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
