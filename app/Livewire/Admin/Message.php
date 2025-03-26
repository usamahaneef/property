<?php

namespace App\Livewire\Admin;

use App\Models\Chat;
use Livewire\Component;

class Message extends Component
{
    // use WithFileUploads;

    public $message = '';
    public $file;
    public $chat;
    public $chats = [];

    public function mount($chat)
    {
        $this->chat = $chat;
        $this->fetchChats();
    }

    public function render()
    {
        return view('livewire.admin.message');
    }

    public function fetchChats()
    {
        $this->chats = Chat::where('member_id', $this->chat->member_id)
                        ->orWhere('admin_id', $this->chat->member_id)
                        ->orderBy('id', 'ASC')
                        ->get();
    }

    public function SendMessage()
    {
        $this->validate([
            'message' => 'nullable|string',
            'file' => 'nullable|image|max:1024',
        ]);

        $chat = new Chat();
        $chat->admin_id = auth()->user()->id;
        $chat->member_id = $this->chat->member_id;
        $chat->message = $this->message;
        $chat->save();

        if ($this->file) {
            $chat->addMedia($this->file)->toMediaCollection('attachment');
        }

        $this->reset(['message', 'file']);
        $this->fetchChats();
    }

    public function resetFile()
    {
        $this->reset('file');
    }

}
