<?php

namespace App\Livewire\Admin;

use App\Models\Chat as ModelsChat;
use Livewire\Component;
use Livewire\WithPagination;

class Chat extends Component
{
    use WithPagination;
    public $checkedData = [];

    public $search = '';
    public $paginate = 10;
    
    
    public function paginationView()
    {
        return 'livewire.pagination';
    }

    public function render()
    {
        $latestMessagesSubquery = ModelsChat::select('member_id', ModelsChat::raw('MAX(id) as latest_id'))
        ->whereNull('admin_id')
        ->groupBy('member_id');
    
        $chats = ModelsChat::joinSub($latestMessagesSubquery, 'latest_messages', function ($join) {
                $join->on('chats.id', '=', 'latest_messages.latest_id');
            })
            ->where(function ($query) {
                $query->where('chats.id', 'like', '%' . $this->search . '%')
                    ->orWhere('chats.message', 'like', '%' . $this->search . '%');
            })
            ->orderBy('chats.id', 'DESC')
            ->paginate($this->paginate);
        
        return view('livewire.admin.chat', [
            'chats' => $chats,
        ]);
                       
    }

    public function bulkDelete()
    {
        ModelsChat::whereIn('id', $this->checkedData)->delete();
        session()->flash('success', count($this->checkedData) . 'Chats (s) deleted successfully');
        $this->checkedData = [];
        $this->redirect()->back();
    }
}
