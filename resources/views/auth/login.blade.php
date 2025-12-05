@extends('layouts.guest')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">

    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">

        <h2 class="text-center text-2xl font-bold text-green-600 mb-6">
            Masuk ke MyFlorist
        </h2>

        <!-- FORM LOGIN -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- EMAIL -->
            <div class="mb-4">
                <label for="email" class="block text-gray-800 font-semibold mb-1">Email</label>
                <input id="email" type="email" name="email"
                       class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-800 
                              focus:ring-2 focus:ring-green-500"
                       placeholder="Email Anda" required autofocus>
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">
                <label for="password" class="block text-gray-800 font-semibold mb-1">Password</label>
                <input id="password" type="password" name="password"
                       class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-800 
                              focus:ring-2 focus:ring-green-500"
                       placeholder="Masukkan password" required>
            </div>

            <!-- REMEMBER ME -->
            <div class="flex items-center mb-4">
                <input type="checkbox" id="remember_me" name="remember"
                       class="mr-2 rounded border-gray-300">
                <label for="remember_me" class="text-gray-700 text-sm">Ingat saya</label>
            </div>

            <!-- LOGIN BUTTON -->
            <button type="submit"
                class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                Masuk
            </button>

        </form>

        <!-- REGISTER -->
        <p class="mt-4 text-center text-sm">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-green-600 font-semibold hover:underline">
                Daftar
            </a>
        </p>

    </div>
</div>
@endsection
