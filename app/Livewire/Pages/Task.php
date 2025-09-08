<?php

namespace App\Livewire\Pages;

use App\Models\CategoryTask;
use App\Models\Task as ModelsTask;
use Flux\Flux;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Task extends Component
{
    #[Title('Halaman Tasks')]

    public $title;
    public $content;
    public $priority;
    public $category_id = null;
    public $due_date;
    public $categories = [];
    public $tasks = [];
    public $is_success = false;
    public $ready_for_create = false;

    protected $rules = [
        'title' => 'required|string',
        'priority' => 'required|in:high,medium,low',
        'content' => 'nullable|string',
        'is_success' => 'boolean',
        'category_id' => 'nullable|exists:category_tasks,id',
        'due_date' => 'nullable|date',
    ];

    protected $messages = [
        'title.required' => 'Judul harus diisi',
        'title.string' => 'Judul harus berupa teks',
        'priority.required' => 'Prioritas harus diisi',
        'priority.in' => 'Prioritas tidak valid',
        'content.string' => 'Konten harus berupa teks',
        'is_success.boolean' => 'Status tidak valid',
        'category_id.exists' => 'Kategori tidak valid',
        'due_date.date' => 'Tanggal tidak valid',
    ];

    public function mount()
    {
        $this->loadData();
        Flux::modal('modal-show-filter')->show();
    }

    #[On('set-category')]
    public function setCategory($category_id)
    {
        $categories = $this->loadCategory();
        $this->categories = $categories;
        $this->category_id = $category_id;
    }

    public function updated()
    {
        $this->validate();
        if ($this->title && $this->priority) {
            $this->ready_for_create = true;
        }
    }

    #[On('task-updated')]
    public function loadData()
    {
        $categories = $this->loadCategory();
        $this->categories = $categories;
    }
    public function loadCategory()
    {
        return CategoryTask::select('id', 'name')->get();
    }

    public function createCategory()
    {
        Flux::modal('modal-create-category')->show();
    }
    public function showFilter()
    {
        Flux::modal('modal-show-filter')->show();
    }
    public function save()
    {
        $this->validate();
        ModelsTask::create([
            'title' => $this->title,
            'content' => $this->content,
            'due_date' => $this->due_date,
            'is_success' => $this->is_success,
            'priority' => $this->priority,
            'category_id' => $this->category_id,
        ]);
        $this->reset();
        $this->ready_for_create = false;
        $this->dispatch('task-updated');
        $this->dispatch('notify', variant: 'success', message: 'Task berhasil ditambahkan');
    }

    public function render()
    {
        return view('livewire.pages.task')
            ->layout('components.layouts.app');
    }
}
