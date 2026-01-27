@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    <h2 class="text-2xl font-bold mb-4">Pesan Bantuan</h2>

    <div class="bg-white shadow rounded-lg flex h-[450px]">

        <div class="w-1/3 border-r p-4">
            <p class="text-gray-500">Belum ada tiket pelaporan</p>
        </div>

        <div class="flex-1 flex flex-col items-center justify-center">
            <img src="https://i.ibb.co/ZV0z9wb/help.png" class="w-48 mb-4" />
            <h3 class="text-xl font-bold">Halo, {{ strtoupper(auth()->user()->name) }}!</h3>
            <p class="text-gray-500">Seluruh keluhan yang kamu laporkan akan tampil di sini</p>
        </div>
    </div>

</div>
@endsection
