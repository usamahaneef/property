<?php

namespace App\Livewire\Admin;

use App\Models\Property as ModelsProperty;
use Livewire\Component;
use Livewire\WithPagination;

class Property extends Component
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
        $properties = ModelsProperty::query();
        if ($this->search) {
            $properties->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    // ->orWhereHas('customer', function ($q) {
                    //     $q->where('name', 'like', '%' . $this->search . '%');
                    //     $q->where('nic', 'like', '%' . $this->search . '%');
                    //     $q->where('phone', 'like', '%' . $this->search . '%');
                    // })
                    ->orWhere('name', 'like', '%' . $this->search . '%')
                    ->orWhere('size', 'like', '%' . $this->search . '%')
                    ->orWhere('location', 'like', '%' . $this->search . '%');
            });
        }
        
        if ($this->dateFilter && $this->start_date && $this->end_date) {
            $startDate = $this->start_date;
            $endDate = $this->end_date;
            $properties->whereBetween('date', [$startDate, $endDate]);
        }
        
        $properties = $properties->orderBy('id', 'DESC')
            ->paginate($this->paginate);
            
        return view('livewire.admin.property', [
            'properties' => $properties,
        ]);
    }
}
