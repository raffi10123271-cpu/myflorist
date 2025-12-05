@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Notifikasi</h1>

    <form action="{{ route('notifications.readAll') }}" method="POST" class="mb-4">
        @csrf
        <button class="bg-gray-700 text-white px-3 py-1 rounded">Tandai semua sudah dibaca</button>
    </form>

    <div class="space-y-3">
        @foreach($notifications as $n)
            @php $data = $n->data; @endphp
            <div class="p-4 bg-white rounded shadow {{ $n->read_at ? 'opacity-60' : '' }}">
                <div class="flex justify-between">
                    <div>
                        <p class="font-semibold">{{ $data['message'] ?? 'Notifikasi baru' }}</p>
                        <p class="text-sm text-gray-600">{{ $n->created_at->diffForHumans() }}</p>
                        @if(isset($data['items']))
                            <p class="text-sm mt-2">Items: {{ count($data['items']) }}</p>
                        @endif
                    </div>
                    @if(isset($notification->data['chat_url']))
                            <a href="{{ $notification->data['chat_url'] }}" class="text-green-600">
                             Buka Chat dengan Seller
                        </a>
                    @endif

                    <div class="text-right">
                        @if(!$n->read_at)
                            <form action="{{ route('notifications.read', $n->id) }}" method="POST">
                                @csrf
                                <button class="text-blue-600">Tandai sudah dibaca</button>
                            </form>
                        @else
                            <span class="text-sm text-green-600">Sudah dibaca</span>
                        @endif

                        @if(!empty($data['url']))
                            <div class="mt-2">
                                <a href="{{ $data['url'] }}" class="text-sm text-indigo-600">Lihat</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
