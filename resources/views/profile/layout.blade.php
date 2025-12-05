@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">

    <h2 class="text-2xl font-bold mb-4">{{ auth()->user()->name }}</h2>

    <!-- TAB MENU -->
    <div class="border-b mb-6 flex space-x-6 text-lg">
        <a href="{{ route('profile') }}"
           class="{{ request()->routeIs('profile') ? 'border-b-2 border-green-600 text-green-600' : '' }}">
           Biodata Diri
        </a>

        <a href="{{ route('profile.addresses') }}"
           class="{{ request()->routeIs('profile.addresses') ? 'border-b-2 border-green-600 text-green-600' : '' }}">
           Daftar Alamat
        </a>

        <a href="{{ route('profile.payments') }}"
           class="{{ request()->routeIs('profile.payments') ? 'border-b-2 border-green-600 text-green-600' : '' }}">
           Pembayaran
        </a>

        <a href="{{ route('profile.bank') }}"
           class="{{ request()->routeIs('profile.bank') ? 'border-b-2 border-green-600 text-green-600' : '' }}">
           Rekening Bank
        </a>

        <a href="{{ route('profile.notifications') }}"
           class="{{ request()->routeIs('profile.notifications') ? 'border-b-2 border-green-600 text-green-600' : '' }}">
           Notifikasi
        </a>

        <a href="{{ route('profile.security') }}"
           class="{{ request()->routeIs('profile.security') ? 'border-b-2 border-green-600 text-green-600' : '' }}">
           Keamanan
        </a>
    </div>

    <!-- CONTENT TAB -->
    <div class="bg-white shadow p-6 rounded-lg">
        @yield('profile-content')
    </div>

</div>
@endsection
