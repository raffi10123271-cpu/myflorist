<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - MyFlorist</title>

    <!-- Tailwind CDN (development) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome for icons (optional) -->
    <script src="https://kit.fontawesome.com/a2d9b6d0d0.js" crossorigin="anonymous"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* small tweaks */
        .sidebar-collapsed { width: 72px; }
        .sidebar-expanded { width: 260px; }
        .content-transition { transition: margin-left .2s ease; }
        /* truncate for long text in cards */
        .truncate-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    </style>

</head>
<body class="bg-gray-100 text-gray-900" data-theme="light">

    <div x-data="{ open: false }" class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside id="sidebar" class="bg-green-700 text-white p-6 h-screen sidebar-expanded transition-all"
               style="min-width: 260px;">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <div class="text-2xl font-bold">MyFlorist</div>
                </div>
                <button id="sidebarToggle" class="text-white text-lg" title="Toggle sidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded hover:bg-green-600">Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="block py-2 px-3 rounded hover:bg-green-600">Manajemen User</a>
                <a href="{{ route('admin.categories.index') }}" class="block py-2 px-3 rounded hover:bg-green-600">Kategori</a>
                <a href="{{ route('admin.products.index') }}" class="block py-2 px-3 rounded hover:bg-green-600">Produk</a>
                <a href="{{ route('admin.seller.requests') }}" class="block py-2 px-3 rounded hover:bg-green-600">Seller Pending</a>
            </nav>

            <div class="mt-8 text-sm text-green-200">
                <p>Logged as: <strong>{{ auth()->user()->name ?? 'Admin' }}</strong></p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="mt-3 bg-white text-green-700 px-3 py-2 rounded hover:opacity-90">Logout</button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main id="mainContent" class="flex-1 p-6 content-transition" style="margin-left: 0;">
            <!-- Topbar -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-4">
                    <h1 class="text-2xl font-bold">@yield('page-title', 'Dashboard Admin')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Notification icon -->
                    <div class="relative">
                        <button id="notifBtn" class="p-2 rounded bg-white/10 hover:bg-white/20">
                            <i class="fas fa-bell"></i>
                            <span id="notifBadge" class="text-xs bg-red-500 text-white rounded-full px-1 ml-1">3</span>
                        </button>
                    </div>

                    <!-- Chat -->
                    <a href="{{ route('chat') }}" class="p-2 rounded bg-white/10 hover:bg-white/20" title="Chat">
                        <i class="fas fa-comment"></i>
                    </a>

                    <!-- Dark mode -->
                    <button id="themeToggle" class="p-2 rounded bg-white/10 hover:bg-white/20" title="Toggle theme">
                        <i id="themeIcon" class="fas fa-moon"></i>
                    </button>

                    <!-- Profile dropdown -->
                    <div class="relative">
                        <button id="profileBtn" class="flex items-center gap-2 p-2 rounded bg-white/10 hover:bg-white/20">
                            <span class="w-8 h-8 rounded-full bg-green-200 text-green-800 flex items-center justify-center uppercase">
                                {{ substr(auth()->user()->name ?? 'A',0,1) }}
                            </span>
                            <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white text-black rounded shadow-lg">
                            <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('profile') }}">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- page content -->
            <div class="bg-transparent">
                @yield('content')
            </div>
        </main>

    </div>

    <script>
        // Sidebar toggle
        const sb = document.getElementById('sidebar');
        const main = document.getElementById('mainContent');
        const toggle = document.getElementById('sidebarToggle');
        toggle.addEventListener('click', () => {
            if (sb.classList.contains('sidebar-expanded')) {
                sb.classList.remove('sidebar-expanded');
                sb.classList.add('sidebar-collapsed');
                sb.style.minWidth = '72px';
                main.style.marginLeft = '72px';
            } else {
                sb.classList.remove('sidebar-collapsed');
                sb.classList.add('sidebar-expanded');
                sb.style.minWidth = '260px';
                main.style.marginLeft = '260px';
            }
        });

        // Profile dropdown
        const profileBtn = document.getElementById('profileBtn');
        const profileMenu = document.getElementById('profileMenu');
        profileBtn && profileBtn.addEventListener('click', () => {
            profileMenu.classList.toggle('hidden');
        });

        // Theme toggle (light/dark)
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        function setTheme(t) {
            if (t === 'dark') {
                document.documentElement.classList.add('dark');
                document.body.classList.add('bg-gray-900');
                themeIcon.className = 'fas fa-sun';
            } else {
                document.documentElement.classList.remove('dark');
                document.body.classList.remove('bg-gray-900');
                themeIcon.className = 'fas fa-moon';
            }
            localStorage.setItem('mf_theme', t);
        }
        const saved = localStorage.getItem('mf_theme') || 'light';
        setTheme(saved);
        themeToggle.addEventListener('click', () => {
            setTheme((localStorage.getItem('mf_theme') === 'dark') ? 'light' : 'dark');
        });

        // simple notif button (toggle)
        document.getElementById('notifBtn').addEventListener('click', () => {
            alert('Notifikasi: fitur demo - implementasikan endpoint notifikasi sesuai kebutuhan.');
        });
    </script>

    @stack('scripts')
</body>
</html>
