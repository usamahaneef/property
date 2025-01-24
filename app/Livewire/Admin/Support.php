<?php

namespace App\Livewire\Admin;

use App\Models\Admin\Support as AdminSupport;
use Livewire\Component;
use Livewire\WithPagination;

class Support extends Component
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
        $supports = AdminSupport::query();
        if ($this->search) {
            $supports->where(function ($query) {
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
            $supports->whereBetween('date', [$startDate, $endDate]);
        }
        
        $supports = $supports->orderBy('id', 'DESC')
            ->paginate($this->paginate);
            
        return view('livewire.admin.support', [
            'supports' => $supports,
        ]);
    }
}
