@extends('profile.layout')

@section('profile-content')
<h3 class="text-xl font-semibold mb-4">Tambah Rekening Baru</h3>

<form action="{{ route('profile.bank.store') }}" method="POST">
    @csrf

    <!-- DROPDOWN NAMA BANK -->
    <div class="mb-3">
        <label class="font-semibold">Pilih Bank</label>
        <select name="bank_name" class="border p-2 w-full" required>
            <option value="">-- Pilih Bank --</option>
            <option value="BCA">BCA</option>
            <option value="BRI">BRI</option>
            <option value="BNI">BNI</option>
            <option value="Mandiri">Bank Mandiri</option>
            <option value="BTN">BTN</option>
            <option value="CIMB Niaga">CIMB Niaga</option>
            <option value="Danamon">Danamon</option>
        </select>
    </div>

    <!-- NAMA PEMILIK REKENING -->
    <div class="mb-3">
        <label class="font-semibold">Nama Pemilik Rekening</label>
        <input type="text" name="account_name" class="border p-2 w-full" required>
    </div>

    <!-- NOMOR REKENING -->
    <div class="mb-3">
        <label class="font-semibold">Nomor Rekening</label>
        <input type="text" name="account_number" class="border p-2 w-full" required>
    </div>

    <!-- SUBMIT -->
    <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded">
        Simpan Rekening
    </button>
</form>
@endsection
