<?php

namespace App\Livewire\Components\Modal;

use App\Models\CategoryTask;
use Flux\Flux;
use Livewire\Component;

class CreateCategory extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|min:2|max:20'
    ];

    protected $messages = [
        'name.required' => 'Nama Kategori harus diisi',
        'name.min' => 'Nama Kategori minimal 2 karakter',
        'name.max' => 'Nama Kategori maksimal 20 karakter',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function resetCategoryId()
    {
        $this->dispatch('set-category', category_id: null);
    }

    public function save()
    {
        $this->validate();
        $category = CategoryTask::create([
            'name' => $this->name,
        ]);
        $this->reset();
        $this->dispatch('category-updated');
        $this->dispatch('set-category', category_id: $category->id);
        $this->dispatch('notify', variant: 'success', message: 'Kategori berhasil ditambahkan');
        Flux::modal('modal-create-category')->close();
    }
    public function render()
    {
        return view('livewire.components.modal.create-category');
    }
}
