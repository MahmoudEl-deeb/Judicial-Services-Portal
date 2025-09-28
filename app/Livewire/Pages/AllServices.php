<?php

namespace App\Livewire\Pages;

use App\Models\ServiceType;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class AllServices extends Component
{
    use WithPagination;

    public $searchTerm = '';
    public $sortBy = 'name';
    public $activeOnly = false;
    public $perPage = 12;

    protected $queryString = [
        'searchTerm' => ['except' => ''],
        'sortBy' => ['except' => 'name'],
        'activeOnly' => ['except' => false],
    ];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function updatingActiveOnly()
    {
        $this->resetPage();
    }

    public function toggleActiveOnly()
    {
        $this->activeOnly = !$this->activeOnly;
    }

    public function clearFilters()
    {
        $this->reset(['searchTerm', 'sortBy', 'activeOnly']);
    }

    public function getServicesProperty()
    {
        $query = ServiceType::query();

        // Search filter
        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('service_name_ar', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('description_ar', 'like', '%' . $this->searchTerm . '%');
            });
        }

        // Active filter
        if ($this->activeOnly) {
            $query->where('is_active', true);
        }

        // Sorting
        switch ($this->sortBy) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('service_name_ar', 'asc');
                break;
        }

        return $query->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.pages.all-services', [
            'services' => $this->services,
            'totalServices' => ServiceType::count()
        ]);
    }
}
