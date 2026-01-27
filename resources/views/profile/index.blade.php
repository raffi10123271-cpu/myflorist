@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto grid grid-cols-12 gap-6">

    <!-- SIDEBAR -->
    <aside class="col-span-3 bg-white shadow rounded-lg p-4">
        <div class="flex items-center space-x-3 border-b pb-3 mb-4">
            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&size=60"
                 class="rounded-full w-12 h-12">
            <div>
                <p class="font-bold text-lg">{{ auth()->user()->name }}</p>
                <p class="text-sm text-gray-500">Member</p>
            </div>
        </div>

        <nav class="flex flex-col space-y-2 font-semibold">
            <a href="#" class="text-gray-700">Chat</a>
            

           @php
    $status = auth()->user()->seller_status;
@endphp

@if(auth()->user()->seller_status === 'none')
    <a href="{{ route('seller.registerForm') }}"
       class="bg-yellow-500 text-white py-2 px-4 rounded block text-center">
       Daftar Jadi Seller
    </a>
@elseif(auth()->user()->seller_status === 'pending')
    <span class="bg-gray-400 text-white py-2 px-4 rounded block text-center">
        Menunggu Verifikasi Admin
    </span>
@elseif(auth()->user()->seller_status === 'approved')
    <a href="{{ route('seller.dashboard') }}"
       class="bg-green-600 text-white py-2 px-4 rounded block text-center">
       Masuk Dashboard Seller
    </a>

@elseif ($status === 'rejected')
    <button class="mt-4 w-full bg-red-500 text-white py-2 rounded-lg" disabled>
        Pengajuan Ditolak
    </button>
@endif

        </nav>
    </aside>

    <!-- KONTEN -->
    <section class="col-span-9 bg-white shadow rounded-lg p-6">

        <!-- TAB MENU -->
        @php
    $active = $tab;
@endphp

<div class="flex space-x-6 border-b pb-2">

    <a href="{{ route('profile.tab', 'biodata') }}"
       class="{{ $active === 'biodata' ? 'text-green-600 font-bold border-b-2 border-green-600' : 'text-gray-500' }}">
        Biodata Diri
    </a>

    <a href="{{ route('profile.tab', 'addresses') }}"
       class="{{ $active === 'addresses' ? 'text-green-600 font-bold border-b-2 border-green-600' : 'text-gray-500' }}">
        Daftar Alamat
    </a>

    <a href="{{ route('profile.tab', 'payments') }}"
   class="{{ $active === 'payments' ? 'text-green-600 font-bold border-b-2 border-green-600' : 'text-gray-500' }}">
    Rekening Anda
</a>

    <a href="{{ route('profile.tab', 'notifications') }}"
       class="{{ $active === 'notifications' ? 'text-green-600 font-bold border-b-2 border-green-600' : 'text-gray-500' }}">
        Notifikasi
    </a>

</div>


        {{-- LOAD TAB --}}
        @include('profile.tabs.' . $tab)

    </section>

</div>
@endsection
