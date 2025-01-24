<?php

namespace App\Livewire\Admin;

use App\Models\Admin\Chat as AdminChat;
use Livewire\Component;
use Livewire\WithPagination;

class Chat extends Component
{
    use WithPagination;
    public $search = '';
    public $paginate = 10;
    public $start_date;
    public $end_date;
    public $dateFilter = false;

    public function clearFilters()
    {
        $this->reset('search', 'start_date', 'end_date', 'dateFilter');
    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

    public function applyDateFilter()
    {
        $this->dateFilter = true;
    }


    public function render()
    {
        $chats = AdminChat::query();
        if ($this->search) {
            $chats->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    // ->orWhereHas('customer', function ($q) {
                    //     $q->where('name', 'like', '%' . $this->search . '%');
                    //     $q->where('nic', 'like', '%' . $this->search . '%');
                    //     $q->where('phone', 'like', '%' . $this->search . '%');
                    // })
                    ->orWhere('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }
        
        if ($this->dateFilter && $this->start_date && $this->end_date) {
            $startDate = $this->start_date;
            $endDate = $this->end_date;
            $chats->whereBetween('date', [$startDate, $endDate]);
        }
        
        $chats = $chats->orderBy('id', 'DESC')
            ->paginate($this->paginate);
            
        return view('livewire.admin.chat', [
            'chats' => $chats,
        ]);
    }
}
