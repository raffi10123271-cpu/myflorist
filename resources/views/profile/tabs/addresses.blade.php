<h3 class="text-xl font-semibold mb-4">Daftar Alamat</h3>

<a href="#" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah Alamat Baru</a>

<div class="mt-4 space-y-4">
    @forelse ($addresses as $address)
        <div class="border rounded p-4 bg-green-50">
            <h4 class="font-semibold">{{ $address->label }} 
                @if ($address->is_primary)
                    <span class="text-xs bg-green-600 text-white px-2 py-1 rounded">Utama</span>
                @endif
            </h4>

            <p class="mt-2">{{ $address->receiver }} ({{ $address->phone }})</p>

            <p class="text-sm text-gray-700 mt-1">{{ $address->full_address }}</p>

            <div class="flex gap-4 mt-3">
                <a class="text-blue-600" href="#">Ubah Alamat</a>
                <a class="text-red-600" href="#">Hapus</a>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Belum ada alamat.</p>
    @endforelse
</div>
