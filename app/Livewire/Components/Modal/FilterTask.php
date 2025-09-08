<?php

namespace App\Livewire\Components\Modal;

use App\Models\CategoryTask;
use Flux\Flux;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class FilterTask extends Component
{
    public $category_id;
    public $is_success;
    public $filterDate;

    #[Computed()]
    public function loadCategories()
    {
        return CategoryTask::select(['id', 'name'])->get();
    }

    #[On('set-category')]
    public function refreshCategory()
    {
        $this->loadCategories();
    }
    public function resetData()
    {
        $this->reset();
    }
    public function save()
    {

        if ($this->filterDate !== null) {
            $this->dispatch('change-filter-date', date: $this->filterDate);
        }
        if ($this->is_success !== null) {
            $this->dispatch('change-filter-status', status: filter_var($this->is_success, FILTER_VALIDATE_BOOLEAN));
        }
        if ($this->category_id) {
            $crypt_category_id = Crypt::encryptString((string) $this->category_id);
            $this->dispatch('change-filter-category', category_id: $crypt_category_id);
        }
        Flux::modal('modal-show-filter')->close();
    }
    public function render()
    {
        return view('livewire.components.modal.filter-task');
    }
}
