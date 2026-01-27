@extends('admin.layout')

@section('page-title', 'Dashboard Admin')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white p-6 shadow rounded-lg">
        <p class="text-gray-600">Seller Pending</p>
        <h2 class="text-3xl font-bold">{{ $pending_sellers_count ?? 0 }}</h2>
    </div>

    <div class="bg-white p-6 shadow rounded-lg">
        <p class="text-gray-600">Seller Aktif</p>
        <h2 class="text-3xl font-bold">{{ $total_sellers ?? 0 }}</h2>
    </div>

    <div class="bg-white p-6 shadow rounded-lg">
        <p class="text-gray-600">Total User</p>
        <h2 class="text-3xl font-bold">{{ $total_users ?? 0 }}</h2>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Chart -->
    <div class="col-span-2 bg-white p-6 shadow rounded-lg">
        <h3 class="font-semibold mb-4">Penjualan 6 Bulan Terakhir</h3>
        <canvas id="salesChart" height="120"></canvas>
    </div>

    <!-- Quick stats -->
    <div class="bg-white p-6 shadow rounded-lg">
        <h3 class="font-semibold mb-4">Statistik Cepat</h3>
        <div class="space-y-4">
            <div>
                <div class="text-sm text-gray-500">Produk</div>
                <div class="text-xl font-bold">{{ $total_products ?? 0 }}</div>
            </div>
            <div>
                <div class="text-sm text-gray-500">Pesanan</div>
                <div class="text-xl font-bold">{{ $total_orders ?? 0 }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Pending sellers list -->
<div class="bg-white p-6 shadow rounded-lg">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold">Seller Pending Terbaru</h3>
        <a href="{{ route('admin.seller.requests') }}" class="text-sm text-green-600">Lihat semua</a>
    </div>

    @if($pending_sellers->isEmpty())
        <div class="text-gray-500">Tidak ada seller pending.</div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="text-left text-sm text-gray-600">
                        <th class="py-2">Nama</th>
                        <th class="py-2">Email</th>
                        <th class="py-2">Username</th>
                        <th class="py-2">Telepon</th>
                        <th class="py-2">Dibuat</th>
                        <th class="py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($pending_sellers as $s)
                    <tr class="border-b">
                        <td class="py-3">{{ $s->name }}</td>
                        <td class="py-3">{{ $s->email }}</td>
                        <td class="py-3">{{ $s->username ?? '-' }}</td>
                        <td class="py-3">{{ $s->phone ?? '-' }}</td>
                        <td class="py-3">{{ $s->created_at->format('d M Y H:i') }}</td>
                        <td class="py-3">
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('admin.seller.approve', $s->id) }}">
                                    @csrf
                                    <button class="px-3 py-1 bg-green-600 text-white rounded">Approve</button>
                                </form>

                                <form method="POST" action="{{ route('admin.seller.reject', $s->id) }}">
                                    @csrf
                                    <button class="px-3 py-1 bg-red-500 text-white rounded">Reject</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@push('scripts')
<script>
    // Chart.js data from server
    const labels = @json($chart_labels ?? []);
    const data = @json($chart_data ?? []);
    const ctx = document.getElementById('salesChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Pesanan',
                data: data,
                fill: true,
                tension: 0.3,
                borderWidth: 2,
                backgroundColor: 'rgba(34,197,94,0.12)',
                borderColor: 'rgba(34,197,94,0.9)',
                pointBackgroundColor: 'rgba(34,197,94,1)'
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { precision:0 } }
            }
        }
    });
</script>
@endpush

@endsection
