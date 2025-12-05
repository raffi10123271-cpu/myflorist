<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyFlorist Marketplace</title>
    
     @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<body class="bg-gray-100">

<nav class="w-full bg-white shadow-sm fixed top-0 left-0 z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between py-3 px-4">

        <!-- LOGO -->
        <a href="/" class="flex items-center">
            <span class="text-2xl font-extrabold text-green-600">MyFlorist</span>
        </a>

        <!-- SEARCH BAR (Hanya tampil jika bukan login/register) -->
        @if(!request()->is('login') && !request()->is('register'))
            <div class="flex-1 px-6">
                <input type="text" placeholder="Cari buket bunga..."
                    class="w-full bg-gray-800 text-white rounded-full py-2 px-4 focus:ring-2 focus:ring-green-500" />
            </div>
        @else
            <div class="flex-1"></div>
        @endif

        <!-- ICONS + DROPDOWN -->
        <div class="flex items-center space-x-6 text-gray-700">

            @guest
                <!-- BELUM LOGIN -->
                <a href="{{ route('login') }}" class="hover:text-green-600">Masuk</a>
                <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-full">
                    Daftar
                </a>
            @endguest

            @auth
                <!-- CART -->
                <a href="{{ route('cart') }}" class="hover:text-green-600 text-xl">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>

                <!-- NOTIFIKASI -->
            @php
                $notifCount = auth()->user()->unreadNotifications->count();
            @endphp

            <a href="{{ route('notifications') }}" class="relative hover:text-green-600 text-xl">
                <i class="fa-solid fa-bell"></i>

             @if($notifCount > 0)
                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">
                {{ $notifCount }}
                </span>
             @endif
            </a>


                <!-- MESSAGE -->
                <a href="{{ route('chat.list') }}" class="hover:text-green-600 text-xl">
                    <i class="fa-solid fa-envelope"></i>
                </a>

                <!-- TOKO HANYA UNTUK SELLER -->
                @if(auth()->user()->role === 'seller')
                    <a href="{{ route('seller.dashboard') }}" class="hover:text-green-600 font-semibold">
                        Toko
                    </a>
                @endif

                <!-- DROPDOWN -->
                <div x-data="{ open:false }" class="relative">
                    <button @click="open = !open" class="flex items-center cursor-pointer">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0D8C3C&color=fff"
                             class="w-8 h-8 rounded-full mr-2">
                        <span class="font-semibold">{{ auth()->user()->name }}</span>
                    </button>

                    <div x-show="open" @click.outside="open = false"
                        class="absolute right-0 mt-3 w-72 bg-white shadow-xl rounded-xl border p-4 z-50">

                        <div class="flex items-center space-x-3 mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0D8C3C&color=fff"
                                 class="w-12 h-12 rounded-full">
                            <div>
                                <h4 class="font-bold text-lg">{{ auth()->user()->name }}</h4>
                                <p class="text-green-600 text-sm font-semibold">Member</p>
                            </div>
                        </div>

                        <hr class="my-2">

                        <a href="#" class="block py-2 hover:text-green-600">Pembelian</a>
                        <a href="#" class="block py-2 hover:text-green-600">Wishlist</a>
                        <a href="#" class="block py-2 hover:text-green-600">Pengaturan</a>
                        <a href="#" class="block py-2 hover:text-green-600">Toko Favorit</a>
                        <a href="{{ route('profile') }}" class="block py-2 hover:text-green-600">Pengaturan Profil</a>
                        
                        <form action="{{ route('logout') }}" method="POST" class="mt-3">
                            @csrf
                            <button class="text-red-600 font-semibold">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth

        </div>

    </div>
</nav>



<!-- SPACER (agar konten tidak tertutup navbar fixed) -->
<div class="h-20"></div>

<main class="container mx-auto px-4 py-6">
    @yield('content')
</main>

<!-- Alpine -->
<script src="https://unpkg.com/alpinejs" defer></script>

    <script>
    @auth
        Echo.private('user.{{ auth()->id() }}')
            .listen('NewNotificationEvent', (e) => {
                let badge = document.getElementById('notifBadge');
                if (badge) {
                    badge.innerText = e.count;
                    badge.classList.remove('hidden');
                }
            });
    @endauth
</script>

</body>
</html>
