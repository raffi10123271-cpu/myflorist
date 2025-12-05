@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">

    <h2 class="text-xl font-semibold mb-4">
        Chat dengan {{ $seller->name }}
    </h2>

    <!-- CHAT BOX -->
    <div id="chatBox" class="h-96 overflow-y-auto border p-4 mb-4 bg-gray-50">
        @foreach ($messages as $msg)
            <div class="mb-3 {{ $msg->sender_id == auth()->id() ? 'text-right' : '' }}">
                <p class="inline-block px-3 py-2 rounded-lg 
                    {{ $msg->sender_id == auth()->id() ? 'bg-green-500 text-white' : 'bg-gray-300' }}">
                    {{ $msg->message }}
                </p>
                <div class="text-xs text-gray-600 mt-1">
                    {{ $msg->created_at->diffForHumans() }}
                </div>
            </div>
        @endforeach
    </div>

    <!-- FORM KIRIM PESAN -->
    <form action="{{ route('chat.send') }}" method="POST" class="flex space-x-2">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $sellerId }}">

        <input type="text" name="message"
               class="flex-1 border rounded-lg px-3 py-2"
               placeholder="Tulis pesan..." required>

        <button class="bg-green-600 text-white px-4 py-2 rounded-lg">
            Kirim
        </button>
    </form>

</div>

@endsection

@section('scripts')
<script>
window.Echo.private('chat.{{ auth()->id() }}')
    .listen('ChatMessageSent', (e) => {

        let box = document.getElementById('chatBox');

        // HTML pesan baru
        let bubble = `
            <div class="mb-3">
                <p class="inline-block px-3 py-2 rounded-lg bg-gray-300">
                    ${e.message.message}
                </p>
                <div class="text-xs text-gray-600 mt-1">baru saja</div>
            </div>
        `;

        box.insertAdjacentHTML('beforeend', bubble);

        // auto scroll ke bawah
        box.scrollTop = box.scrollHeight;
    });
</script>
@endsection
