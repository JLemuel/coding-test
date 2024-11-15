<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Database\Eloquent\Builder;

class Opportunities extends Component
{
    use WithPagination;
    
    #[Url] 
    public $perPage = 20;
    
    #[Url] 
    public $search = '';
    
    #[Url]
    public $sortField = 'name';
    
    #[Url]
    public $sortDirection = 'asc';

    public $options;

    public const PER_PAGE_OPTIONS = [20, 50, 100, 250];
    
    public function mount(): void
    {
        $this->options = self::PER_PAGE_OPTIONS;
    }

    public function sortBy(string $field): void
    {
        $this->sortDirection = ($this->sortField === $field) 
            ? ($this->sortDirection === 'asc' ? 'desc' : 'asc')
            : 'asc';
            
        $this->sortField = $field;
    }

    private function getItemsQuery(): Builder
    {
        return Item::query()
            ->select(['id', 'name'])
            ->when($this->search, function($query) {
                $searchTerm = trim($this->search);
                return $query->where('name', 'like', '%' . $searchTerm . '%');
            });
    }

    private function sortItems($items)
    {
        $collection = collect($items);
        
        return $this->sortDirection === 'asc'
            ? $collection->sortBy('name', SORT_NATURAL)
            : $collection->sortByDesc('name', SORT_NATURAL);
    }

    public function getItems()
    {
        $items = $this->getItemsQuery()->paginate($this->perPage);
        
        $currentPageItems = collect($items->items());
        
        $sortedItems = $this->sortItems($currentPageItems);
        
        $items->setCollection($sortedItems);
        
        return $items;
    }

    public function render()
    {
        return view('livewire.opportunities', [
            'items' => $this->getItems()
        ]);
    }

    public function updating(string $property): void
    {
        if (in_array($property, ['search', 'perPage'])) {
            $this->resetPage();
        }
    }
}
