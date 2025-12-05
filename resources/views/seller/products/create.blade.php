@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="block mb-1 font-semibold">Nama Produk</label>
        <input type="text" name="title" class="border p-2 w-full mb-3">

        <label class="block mb-1 font-semibold">Harga</label>
        <input type="number" name="price" class="border p-2 w-full mb-3">

        <label class="block mb-1 font-semibold">Stok</label>
        <input type="number" name="stock" class="border p-2 w-full mb-3">

        <label class="block mb-1 font-semibold">Deskripsi</label>
        <textarea name="description" class="border p-2 w-full mb-3"></textarea>

        <label class="block mb-1 font-semibold">Foto Produk</label>
        <input type="file" name="images[]" multiple class="border p-2 w-full mb-3">

        <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>

    </form>

</div>

@endsection
