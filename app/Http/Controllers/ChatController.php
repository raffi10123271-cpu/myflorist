<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Events\MessageSent;

class ChatController extends Controller
{
    // tampilkan halaman chat antara buyer dan seller
    public function index($orderId)
    {
        $order = Order::findOrFail($orderId);

        // tentukan seller berdasarkan produk
        $sellerId = $order->items->first()->product->seller_id;

        $messages = Message::where('order_id', $orderId)
            ->orderBy('created_at')
            ->get();
        
        $chats = \App\Models\ChatMessage::where('sender_id', auth()->id())
        ->orWhere('receiver_id', auth()->id())
        ->with(['sender', 'receiver'])
        ->orderBy('created_at', 'DESC')
        ->get()
        ->groupBy(function($msg){
            return $msg->sender_id == auth()->id() 
                ? $msg->receiver_id 
                : $msg->sender_id;
        });

        return view('chat.index', compact('messages', 'order', 'sellerId','chats'));
    }

    // kirim pesan baru
   public function send(Request $request)
{
    $request->validate([
        'message' => 'required',
        'receiver_id' => 'required|exists:users,id'
    ]);

    $msg = ChatMessage::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $request->receiver_id,
        'message' => $request->message
    ]);

    // === BROADCAST REALTIME ===
    broadcast(new ChatMessageSent($msg))->toOthers();

    return back();
}


    public function detail($sellerId)
{
    $messages = \App\Models\ChatMessage::where(function ($q) use ($sellerId) {
        $q->where('sender_id', auth()->id())
          ->where('receiver_id', $sellerId);
    })
    ->orWhere(function ($q) use ($sellerId) {
        $q->where('sender_id', $sellerId)
          ->where('receiver_id', auth()->id());
    })
    ->with(['sender', 'receiver'])
    ->orderBy('created_at')
    ->get();

    $seller = \App\Models\User::findOrFail($sellerId);

    return view('chat.detail', compact('messages', 'sellerId', 'seller'));
}

public function list()
{
    // Ambil seller yang pernah melakukan transaksi dengan user
    $sellers = \App\Models\User::where('role', 'seller')->get();

    return view('chat.list', compact('sellers'));
}


}
