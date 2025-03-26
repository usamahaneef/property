<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat as ModelsChat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('admin.sections.chat.index',[
            'title' => 'Chat',
            'menu_active' => 'chat',
            'nav_sub_menu' => '',
        ]);
    }

    public function show(ModelsChat $chat)
    {
        $chat->read_at = now();
        $chat->save();
        return view('admin.sections.chat.details',[
            'title' => 'CHat',
            'menu_active' => 'chat',
            'nav_sub_menu' => '',
            'chat' => $chat,
        ]);     
    }
}
