<div class="p-4">
    <h3 class="font-bold text-lg mb-3">Rekening Bank Anda</h3>

    @if(isset($bank) && $bank)
        <div class="space-y-2">
            <p><strong>Bank:</strong> {{ $bank->bank_name }}</p>
            <p><strong>Nomor Rekening:</strong> {{ $bank->account_number }}</p>
            <p><strong>Atas Nama:</strong> {{ $bank->account_name }}</p>

            <a href="#" class="text-blue-600 mt-3 block">Ubah Rekening</a>
        </div>
    @else
        <p class="text-gray-500">Anda belum menambahkan rekening bank.</p>

        <a href="#" class="bg-green-600 text-white px-4 py-2 rounded inline-block mt-3">
            + Tambah Rekening
        </a>
    @endif
</div>
