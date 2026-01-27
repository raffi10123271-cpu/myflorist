<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistik dasar
        $total_users = User::count();
        $total_products = Product::count();
        $total_orders = Order::count();

        // Seller counts
        $total_sellers = User::where('role', 'seller')->count();
        $pending_sellers_count = User::where('seller_status', 'pending')->count();

        // Ambil 6 seller pending terbaru (untuk ditampilkan di tabel)
        $pending_sellers = User::where('seller_status', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get(['id','name','email','created_at','username','phone']);

        // Data sample untuk chart (penjualan per bulan, 6 bulan terakhir)
        $labels = [];
        $salesData = [];
        for ($i = 5; $i >= 0; $i--) {
            $dt = Carbon::now()->subMonths($i);
            $labels[] = $dt->format('M Y');
            // Contoh: jumlah pesanan di bulan tersebut
            $sales = Order::whereYear('created_at', $dt->year)
                        ->whereMonth('created_at', $dt->month)
                        ->count();
            $salesData[] = $sales;
        }

        return view('admin.dashboard', [
            'total_users' => $total_users,
            'total_products' => $total_products,
            'total_orders' => $total_orders,
            'total_sellers' => $total_sellers,
            'pending_sellers' => $pending_sellers,
            'pending_sellers_count' => $pending_sellers_count,
            'chart_labels' => $labels,
            'chart_data' => $salesData,
        ]);
    }
}
