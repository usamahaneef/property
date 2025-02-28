<?php

namespace App\Livewire\Admin;

use App\Models\Member as ModelsMember;
use Livewire\Component;
use Livewire\WithPagination;

class Member extends Component
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
        $members = ModelsMember::query();
        if ($this->search) {
            $members->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    // ->orWhereHas('customer', function ($q) {
                    //     $q->where('name', 'like', '%' . $this->search . '%');
                    //     $q->where('nic', 'like', '%' . $this->search . '%');
                    //     $q->where('phone', 'like', '%' . $this->search . '%');
                    // })
                    ->orWhere('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            });
        }
        
        if ($this->dateFilter && $this->start_date && $this->end_date) {
            $startDate = $this->start_date;
            $endDate = $this->end_date;
            $members->whereBetween('date', [$startDate, $endDate]);
        }
        
        $members = $members->orderBy('id', 'DESC')
            ->paginate($this->paginate);
            
        return view('livewire.admin.member', [
            'members' => $members,
        ]);
    }
}
