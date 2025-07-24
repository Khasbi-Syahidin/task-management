<?php

namespace App\Livewire\Components\Modal;

use App\Models\TaskTag;
use Flux\Flux;
use Livewire\Component;

class CreateTag extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|min:2|max:20'
    ];

    protected $messages = [
        'name.required' => 'Nama tag harus diisi',
        'name.min' => 'Nama tag minimal 2 karakter',
        'name.max' => 'Nama tag maksimal 20 karakter',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function resetTagId()
    {
        $this->dispatch('set-tag', tag_id: null);
    }

    public function save()
    {
        $this->validate();
        $tag = TaskTag::create([
            'name' => $this->name,
        ]);
        $this->reset();
        $this->dispatch('set-tag', tag_id: $tag->id);
        $this->dispatch('notify', variant: 'success', message: 'Tag berhasil ditambahkan');
        Flux::modal('modal-create-tag')->close();
    }
    public function render()
    {
        return view('livewire.components.modal.create-tag');
    }
}
