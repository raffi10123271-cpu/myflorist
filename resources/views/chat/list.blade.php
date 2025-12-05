@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">

    <h2 class="text-xl font-semibold mb-4">Daftar Chat</h2>

    @foreach ($sellers as $seller)
        <a href="{{ route('chat.detail', $seller->id) }}"
           class="block p-3 border-b hover:bg-gray-100">
            <strong>{{ $seller->name }}</strong>
            <p class="text-sm text-gray-600">Klik untuk membuka chat</p>
        </a>
    @endforeach

</div>
@endsection
