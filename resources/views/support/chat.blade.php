@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    <h2 class="text-2xl font-bold mb-4">Chat</h2>

    <div class="bg-white shadow rounded-lg flex h-[450px]">

        <!-- LEFT LIST -->
        <div class="w-1/3 border-r p-4 flex flex-col">
            <span class="text-gray-500 mb-4">Tidak Ada Data</span>
        </div>

        <!-- RIGHT PANEL -->
        <div class="flex-1 flex flex-col items-center justify-center">
            <img src="https://i.ibb.co/SQ0bC5S/chat-empty.png" class="w-48 mb-4" />
            <h3 class="text-xl font-bold">Mari memulai obrolan!</h3>
            <p class="text-gray-500">Pilih pesan di samping untuk mulai chat dengan pembeli.</p>
        </div>

    </div>

</div>
@endsection
