<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function chat()
    {
        return view('support.chat');
    }

    public function chatSettings()
    {
        return view('support.chat-settings');
    }

    public function ulasan()
    {
        return view('support.ulasan');
    }

    public function help()
    {
        return view('support.help');
    }

    public function komplain()
    {
        return view('support.komplain');
    }
}
