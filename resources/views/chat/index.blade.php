@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto bg-white shadow rounded-lg p-4">

    <!-- Header / Nama User -->
    <div class="flex items-center mb-4">
        <div class="avatar placeholder mr-3">
            <div class="bg-green-600 text-white rounded-full w-12 h-12 flex items-center justify-center">
                {{ strtoupper(substr($user->name,0,1)) }}
            </div>
        </div>
        <div>
            <h2 class="text-xl font-bold">{{ $user->name }}</h2>
            <p class="text-gray-500 text-sm">Chat dengan penjual</p>
        </div>
    </div>

    <div id="chatBox" class="h-80 overflow-y-auto"></div>

    <!-- BOX CHAT -->
    <div id="chat-box" 
         class="h-96 overflow-y-auto border rounded-lg p-3 bg-gray-50 mb-4">

        @foreach($messages as $m)
            <div class="mb-3 {{ $m->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">

                <div class="inline-block px-4 py-2 rounded-xl 
                    {{ $m->sender_id == auth()->id() ? 'bg-green-500 text-white' : 'bg-gray-300 text-black' }}">
                    {{ $m->message }}
                </div>

                <div class="text-xs text-gray-500 mt-1">
                    {{ $m->created_at->diffForHumans() }}
                </div>

            </div>
        @endforeach

    </div>

    <!-- FORM KIRIM -->
    <form id="chatForm" class="flex space-x-2">
        @csrf
        <input
            type="text"
            id="message"
            name="message"
            class="input input-bordered w-full"
            placeholder="Tulis pesan..."
            autocomplete="off">

        <button class="btn btn-success text-white">
            Kirim
        </button>
    </form>

</div>

<!-- SCRIPT CHAT REALTIME -->
<script>
    const chatBox = document.getElementById('chat-box');

    // AUTO SCROLL KE BAWAH
    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    scrollToBottom();


    // SEND MESSAGE
    document.getElementById('chatForm').onsubmit = async (e) => {
        e.preventDefault();

        let msg = document.getElementById('message').value.trim();
        if (!msg) return;

        await fetch("{{ route('chat.send', $user->id) }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ message: msg }),
        });

        document.getElementById('message').value = "";
    };


    // LISTEN CHAT REALTIME via Reverb
    window.Echo.channel("chat.{{ auth()->id() }}")
        .listen("ChatMessageCreated", (e) => {

            let bubble = `
                <div class="mb-3 text-left">
                    <div class="inline-block px-4 py-2 rounded-xl bg-gray-300 text-black">
                        ${e.chat.message}
                    </div>
                    <div class="text-xs text-gray-500 mt-1">baru saja</div>
                </div>
            `;

            chatBox.insertAdjacentHTML('beforeend', bubble);
            scrollToBottom();
        });
</script>

<script>
    Echo.private('chat.{{ auth()->id() }}')
        .listen('MessageSent', (e) => {
            let box = document.getElementById("chatBox");
            box.innerHTML += `
                <div class="text-left">
                    <p class="inline-block px-3 py-2 rounded-lg bg-gray-300">${e.message.message}</p>
                </div>
            `;
            box.scrollTop = box.scrollHeight;
        });
</script>


@endsection
