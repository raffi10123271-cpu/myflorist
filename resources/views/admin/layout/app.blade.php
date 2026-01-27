<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - MyFlorist</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
        }
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #1e293b;
            color: white;
            position: fixed;
            top: 0; left: 0;
            padding: 20px;
        }
        .sidebar h3 {
            color: #fff;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: #cbd5e1;
            display: block;
            padding: 10px 0;
            text-decoration: none;
        }
        .sidebar a:hover {
            color: white;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <h3>Admin Panel</h3>

        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.products.index') }}">Produk</a>
        <a href="{{ route('admin.categories.index') }}">Kategori</a>
        <a href="{{ route('admin.users.index') }}">Users</a>

        {{-- Menu Verifikasi Seller --}}
        <a href="{{ route('admin.seller.requests') }}">Verifikasi Seller</a>
    </div>

    {{-- Content --}}
    <div class="content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
