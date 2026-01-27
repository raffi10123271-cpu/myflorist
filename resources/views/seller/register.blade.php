@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">

    <h2 class="text-2xl font-bold mb-4">Daftar Jadi Seller</h2>

    <form action="{{ route('seller.register') }}" 
      method="POST" 
      enctype="multipart/form-data">
    @csrf


        <label class="block mt-3">Nama Toko</label>
        <input type="text" name="store_name" class="input" required>

        <label class="block mt-3">Nomor Telepon Toko</label>
        <input type="text" name="store_phone" class="input" required>

        <label class="block mt-3">Alamat Toko</label>
        <input type="text" name="store_address" class="input" required>

        <label class="block mt-3">Deskripsi Toko</label>
        <textarea name="store_description" class="input"></textarea>

        <label class="block mt-3">Logo Toko</label>
        <input type="file" name="store_logo" class="input">

        <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded">
            Daftar Sekarang
        </button>
    </form>

</div>
@endsection
