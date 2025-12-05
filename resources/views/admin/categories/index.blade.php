@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">

<h1 class="text-2xl font-bold mb-4">Kategori</h1>

<a href="{{ route('categories.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">
    Tambah Kategori
</a>

<table class="w-full mt-4 border">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2">Nama</th>
            <th class="p-2">Slug</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $c)
            <tr>
                <td class="p-2">{{ $c->name }}</td>
                <td class="p-2">{{ $c->slug }}</td>
                <td class="p-2">
                    <a href="{{ route('categories.edit', $c->id) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('categories.destroy', $c->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600 ml-2">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>

@endsection
