@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">

<h1 class="text-2xl font-bold mb-4">Data User</h1>

<table class="w-full border">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2">Nama</th>
            <th class="p-2">Email</th>
            <th class="p-2">Role</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $u)
            <tr>
                <td class="p-2">{{ $u->name }}</td>
                <td class="p-2">{{ $u->email }}</td>
                <td class="p-2">{{ $u->role }}</td>
                <td class="p-2">
                    <form action="{{ route('users.destroy', $u->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>

@endsection
