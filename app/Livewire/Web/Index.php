<?php

namespace App\Livewire\Web;

use App\Models\Property;
use Livewire\Component;

class Index extends Component
{
    public $search = '';
    public $paginate = 10;
    public $type = '';
    public $minPrice = 0;
    public $maxPrice = 10000;
    public $bedrooms = '';
    public $bathrooms = '';
    
    
    public function updatedMinPrice()
    {
        $this->filterByPrice();
    }
    public function updatedMaxPrice()
    {
        $this->filterByPrice();
    }
    public function filterByPrice()
    {
        $this->render();
    }
    public function filterByType($selectedType)
    {
        $this->type = $selectedType;
    }
    // public function filterByBedsBaths($bedrooms, $bathrooms)
    // {
    //     $this->bedrooms = $bedrooms;
    //     $this->bathrooms = $bathrooms;
    // }

    public function filterByBedsBaths()
    {
        $this->render(); // Just re-render when filter is applied
    }

    public function render()
    {
        $properties = Property::query();
    
        if ($this->search) {
            $properties->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('title', 'like', '%' . $this->search . '%')
                    ->orWhere('place', 'like', '%' . $this->search . '%');
            });
        }
    
        if (!empty($this->type)) {
            $properties->where('type', $this->type);
        }
    
        if (!empty($this->bedrooms)) {
            $properties->where('bedroom', '>=', (int) $this->bedrooms);
        }
    
        if (!empty($this->bathrooms)) {
            $properties->where('bathroom', '>=', (float) $this->bathrooms);
        }
    
        $properties->whereBetween('amount', [$this->minPrice, $this->maxPrice]);
    
        $properties = $properties->orderBy('id', 'DESC')->get();
    
        return view('livewire.web.index', [
            'properties' => $properties,
        ]);
    }    
}
