<?php

namespace App\Livewire\Web;

use App\Models\Chat as ModelsChat;
use Carbon\Carbon;
use Livewire\Component;

class Chat extends Component
{
    // use WithFileUploads;

    public $message = '';
    public $file;
    public $chats = [];

    public function mount()
    {
        $this->fetchChats();
    }

    public function render()
    {
        return view('livewire.web.chat');
    }

    public function fetchChats()
    {
        $this->chats = ModelsChat::whereMemberId(loggedInMember()->id)
            ->whereDate('created_at', Carbon::today())
            ->orderBy('id', 'ASC')
            ->get();
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required_without:file',
            'file' => 'nullable|image|max:1024',
        ]);

        $chat = new ModelsChat();
        $chat->member_id = loggedInMember()->id;
        $chat->message = $this->message;
        $chat->save();

        if ($this->file) {
            $chat->addMedia($this->file->getRealPath())->toMediaCollection('attachment');
        }

        $this->reset(['message', 'file']);
        $this->fetchChats();
    }

    public function resetFile()
    {
        $this->file = null;
        $this->resetValidation('file');
    }

}
