@extends('layouts.auth')

@section('content')

<h2 class="text-center text-xl font-bold text-green-700 mb-6">
    Daftar Akun MyFlorist
</h2>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <label>Nama</label>
    <input type="text" name="name" class="border p-2 w-full rounded" required>

    <label>Email</label>
    <input type="email" name="email" class="border p-2 w-full rounded" required>

    <label>Username</label>
    <input type="text" name="username" class="border p-2 w-full rounded" required>

    <label>Nomor HP</label>
    <input type="text" name="phone" class="border p-2 w-full rounded" required>

    <label>Password</label>
    <input type="password" name="password" class="border p-2 w-full rounded" required>

    <label>Konfirmasi Password</label>
    <input type="password" name="password_confirmation" class="border p-2 w-full rounded" required>

    <button class="mt-4 w-full bg-green-600 text-white py-2 rounded">
        Daftar Sekarang
    </button>
</form>
</div>

<p class="text-center mt-4 text-sm">
    Sudah punya akun?
    <a href="{{ route('login') }}" class="text-green-600 font-semibold">Masuk</a>
</p>

@endsection
