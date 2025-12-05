<form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="font-semibold">Nama</label>
        <input type="text" name="name" value="{{ auth()->user()->name }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="font-semibold">Email</label>
        <input type="email" name="email" value="{{ auth()->user()->email }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Simpan Perubahan
    </button>
</form>
