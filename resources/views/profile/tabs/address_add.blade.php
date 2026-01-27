@extends('profile.layout')

@section('content')

<div class="bg-white p-6 rounded shadow-md">
    <h2 class="text-2xl font-bold mb-4">Tambah Alamat Baru</h2>

    <form action="{{ route('profile.storeAddress') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Label Alamat --}}
            <div>
                <label class="font-semibold">Label Alamat</label>
                <input type="text" name="label" placeholder="Rumah, Kantor"
                    class="w-full mt-1 p-2 border rounded" required>
            </div>

            {{-- Nama Penerima --}}
            <div>
                <label class="font-semibold">Nama Penerima</label>
                <input type="text" name="receiver" class="w-full mt-1 p-2 border rounded" required>
            </div>

            {{-- Nomor HP --}}
            <div>
                <label class="font-semibold">No. HP</label>
                <input type="text" name="phone" class="w-full mt-1 p-2 border rounded" required>
            </div>

            {{-- Kota --}}
            <div>
                <label class="font-semibold">Kota</label>
                <input type="text" name="city" class="w-full mt-1 p-2 border rounded" required>
            </div>

            {{-- Provinsi --}}
            <div>
                <label class="font-semibold">Provinsi</label>
                <input type="text" name="province" class="w-full mt-1 p-2 border rounded" required>
            </div>

            {{-- Kode Pos --}}
            <div>
                <label class="font-semibold">Kode Pos</label>
                <input type="text" name="postal_code" class="w-full mt-1 p-2 border rounded" required>
            </div>

            {{-- Alamat Lengkap --}}
            <div class="md:col-span-2">
                <label class="font-semibold">Alamat Lengkap</label>
                <textarea name="full_address" class="w-full mt-1 p-2 border rounded h-24" required></textarea>
            </div>

        </div>

        <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded mt-4">
            Simpan Alamat
        </button>

    </form>
</div>

@endsection
