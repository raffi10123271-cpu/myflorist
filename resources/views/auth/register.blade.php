@extends('layouts.auth')

@section('content')

<h2 class="text-center text-xl font-bold text-green-700 mb-6">
    Daftar Akun MyFlorist
</h2>

<form method="POST" action="{{ route('register') }}">
    @csrf

    {{-- NAME --}}
    <div class="mb-4">

    <label for="name" class="block text-gray-800 font-semibold mb-1">Nama Lengkap</label>
    <input id="name" name="name" type="text"
           class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-800 focus:ring-2 focus:ring-green-500"
           placeholder="Nama lengkap Anda" required>
    </div>

    {{-- EMAIL --}}
    <div class="mb-4">
    <label for="email" class="block text-gray-800 font-semibold mb-1">Email</label>
    <input id="email" name="email" type="email"
           class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-800 focus:ring-2 focus:ring-green-500"
           placeholder="Email Anda" required>
    </div>

    {{-- PASSWORD --}}
    <div class="mb-4">
    <label for="password" class="block text-gray-800 font-semibold mb-1">Password</label>
    <input id="password" name="password" type="password"
           class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-800 focus:ring-2 focus:ring-green-500"
           placeholder="Minimal 6 karakter" required>
    </div>

    {{-- CONFIRM --}}
    <div class="mb-6">
    <label for="password_confirmation" class="block text-gray-800 font-semibold mb-1">Konfirmasi Password</label>
    <input id="password_confirmation" name="password_confirmation" type="password"
           class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-800 focus:ring-2 focus:ring-green-500"
           placeholder="Ulangi password" required>
    
    <button class="w-full bg-green-600 text-white py-2 rounded-full hover:bg-green-700 transition">
        Daftar
    </button>
</form>
</div>

<p class="text-center mt-4 text-sm">
    Sudah punya akun?
    <a href="{{ route('login') }}" class="text-green-600 font-semibold">Masuk</a>
</p>

@endsection
