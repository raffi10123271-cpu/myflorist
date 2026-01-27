@extends('admin.layout')

@section('content')

<h1 class="text-2xl font-bold mb-6">Verifikasi Seller</h1>

<table class="w-full bg-white shadow rounded-lg overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3 text-left">Nama Toko</th>
            <th class="p-3 text-left">Pemilik</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-left">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($sellers as $seller)
        <tr class="border-b">
            <td class="p-3">{{ $seller->store_name }}</td>
            <td class="p-3">{{ $seller->user->name }}</td>
            <td class="p-3">{{ $seller->user->seller_status }}</td>
            <td class="p-3 space-x-2">

                @if($seller->user->seller_status == 'pending')

                <form method="POST" action="{{ route('admin.sellers.approve', $seller->user->id) }}" class="inline">
                    @csrf
                    <button class="bg-green-600 text-white px-3 py-1 rounded">Setuju</button>
                </form>

                <form method="POST" action="{{ route('admin.sellers.reject', $seller->user->id) }}" class="inline">
                    @csrf
                    <button class="bg-red-600 text-white px-3 py-1 rounded">Tolak</button>
                </form>

                @else
                    <span class="text-gray-500">-</span>
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
