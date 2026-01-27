<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\User;

class ChatController extends Controller
{
    public function list()
    {
        $userId = auth()->id();

        $sellers = User::where('role', 'seller')->get();

        return view('chat.list', compact('sellers'));
    }

    public function detail($sellerId)
    {
        $messages = ChatMessage::where(function($q) use ($sellerId){
                $q->where('sender_id', auth()->id())
                  ->orWhere('receiver_id', auth()->id());
            })
            ->where(function($q) use ($sellerId){
                $q->where('sender_id', $sellerId)
                  ->orWhere('receiver_id', $sellerId);
            })
            ->orderBy('created_at')
            ->get();

        $seller = User::findOrFail($sellerId);

        return view('chat.detail', compact('seller', 'messages', 'sellerId'));
    }

    public function send(Request $req)
    {
        $req->validate([
            'receiver_id' => 'required|exists:users,id',
            'message'     => 'required|string'
        ]);

        ChatMessage::create([
            'sender_id'   => auth()->id(),
            'receiver_id' => $req->receiver_id,
            'message'     => $req->message
        ]);

        return back();
    }
}
