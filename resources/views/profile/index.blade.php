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

        <nav class="space-y-2">
            <a href="/chat" class="block py-2 hover:text-green-600">Chat</a>
            <a href="#" class="block py-2 hover:text-green-600">Wishlist</a>
            <a href="#" class="block py-2 hover:text-green-600">Toko Favorit</a>
            <a href="{{ route('profile') }}?tab=biodata" class="block py-2 hover:text-green-600">Pengaturan</a>

            <!-- TOMBOL JADI SELLER -->
            @if(auth()->user()->role === 'customer')
            <form action="{{ route('profile.becomeSeller') }}" method="POST">
                @csrf
                <button class="mt-4 w-full bg-yellow-500 text-white py-2 rounded-lg">
                    Daftar Jadi Seller
                </button>
            </form>
            @else
                <a href="{{ route('seller.dashboard') }}"
                   class="mt-4 block w-full bg-green-600 text-white py-2 rounded-lg text-center">
                    Masuk Dashboard Seller
                </a>
            @endif
        </nav>
    </aside>

    <!-- CONTENT -->
    <section class="col-span-9 bg-white shadow rounded-lg p-6">

        <!-- TAB MENU -->
        @php
    $active = request()->segment(2); // profile/biodata → 'biodata'
@endphp

<div class="flex space-x-6 border-b pb-2">

    <a href="{{ route('profile.biodata') }}"
       class="pb-2 {{ $active === 'biodata' ? 'text-green-600 font-semibold border-b-2 border-green-600' : 'text-gray-500' }}">
        Biodata Diri
    </a>

    <a href="{{ route('profile.addresses') }}"
       class="pb-2 {{ $active === 'addresses' ? 'text-green-600 font-semibold border-b-2 border-green-600' : 'text-gray-500' }}">
        Daftar Alamat
    </a>

    <a href="{{ route('profile.payments') }}"
       class="pb-2 {{ $active === 'payments' ? 'text-green-600 font-semibold border-b-2 border-green-600' : 'text-gray-500' }}">
        Pembayaran
    </a>

    <a href="{{ route('profile.bank') }}"
       class="pb-2 {{ $active === 'bank' ? 'text-green-600 font-semibold border-b-2 border-green-600' : 'text-gray-500' }}">
        Rekening Bank
    </a>

    <a href="{{ route('profile.notifications') }}"
       class="pb-2 {{ $active === 'notifications' ? 'text-green-600 font-semibold border-b-2 border-green-600' : 'text-gray-500' }}">
        Notifikasi
    </a>

    <a href="{{ route('profile.security') }}"
       class="pb-2 {{ $active === 'security' ? 'text-green-600 font-semibold border-b-2 border-green-600' : 'text-gray-500' }}">
        Keamanan
    </a>

</div>
        <!-- KONTEN TAB ======================================= -->

        @if($tab == 'biodata')
            @include('profile.tabs.biodata')
        @endif

        @if($tab == 'alamat')
            @include('profile.tabs.addresses')
        @endif

        @if($tab == 'pembayaran')
            @include('profile.tabs.payments')
        @endif

        @if($tab == 'keamanan')
            @include('profile.tabs.security')
        @endif
    </section>

    @section('profile-content')
        @include("profile.tabs." . $tab)
    @endsection

</div>
@endsection
