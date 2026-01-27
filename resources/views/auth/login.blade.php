@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center bg-gray-100 py-10">
    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">

        <h2 class="text-2xl font-bold text-center text-green-600 mb-6">
            Masuk ke MyFlorist
        </h2>

        <!-- Menampilkan pesan sukses dari registrasi -->
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- USER INPUT --}}
            <label class="font-semibold text-sm">Email / Username / Nomor HP</label>
            <input 
                type="text" 
                name="login"
                class="w-full p-3 border rounded-lg mt-1 focus:ring-2 focus:ring-green-500 focus:border-green-500"
                placeholder="Masukkan email, username, atau no HP"
                required
            >

            {{-- PASSWORD --}}
            <label class="font-semibold text-sm mt-4 block">Password</label>
            <input 
                type="password" 
                name="password"
                class="w-full p-3 border rounded-lg mt-1 focus:ring-2 focus:ring-green-500 focus:border-green-500"
                placeholder="Masukkan password"
                required
            >

            {{-- REMEMBER ME --}}
            <div class="flex items-center mt-3">
                <input type="checkbox" name="remember" class="mr-2">
                <span class="text-sm">Ingat saya</span>
            </div>

            {{-- SUBMIT BUTTON --}}
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold mt-6 transition">
                Login
            </button>
        </form>

        <p class="text-center text-sm mt-4">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-green-600 font-semibold hover:underline">Daftar</a>
        </p>

    </div>
</div>
@endsection
