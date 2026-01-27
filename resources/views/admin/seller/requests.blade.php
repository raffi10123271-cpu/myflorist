@extends('admin.layout.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Permintaan Menjadi Seller</h4>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge bg-warning">Pending</span></td>
                    <td>
                        <form action="{{ route('admin.seller.approve', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Setujui</button>
                        </form>

                        <form action="{{ route('admin.seller.reject', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Tolak</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada permintaan seller.</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection
