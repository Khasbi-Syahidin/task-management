<?php

namespace App\Livewire\Components\Modal;

use App\Models\CategoryTask;
use App\Models\Task;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;

class DetailTask extends Component
{
    public $id;
    public $title;
    public $content;
    public $priority;
    public $category_id = null;
    public $due_date;
    public $categories = [];
    public $task;
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

    #[On('set-category')]
    public function setCategory($category_id)
    {
        $this->loadCategory();
        $this->category_id = $category_id;
    }

    public function updated()
    {
        $this->validate();
        if ($this->title && $this->priority) {
            $this->ready_for_create = true;
        }
    }

    #[On('detail-task')]
    public function loadData($id)
    {
        $this->id = $id;
        $categories = $this->loadCategory();
        $this->categories = $categories;
        $this->task = $this->loadTask();
        $this->title = $this->task->title;
        $this->content = $this->task->content;
        $this->is_success = $this->task->is_success;
        $this->priority = $this->task->priority;
        $this->category_id = $this->task->category_id;
        $this->due_date = $this->task->due_date;
    }

    public function loadCategory()
    {
        return CategoryTask::select('id', 'name')->get();
    }
    public function loadTask()
    {
        return Task::select('id', 'title', 'content', 'category_id', 'is_success', 'due_date', 'priority')->where('id', $this->id)->orderBy('created_at', 'desc')->with('category')->first();
    }
    public function createCategory()
    {
        Flux::modal('modal-create-category')->show();
    }

    public function resetTask()
    {
        $this->reset();
    }

    public function save()
    {
        $this->validate();
        Task::create([
            'title' => $this->title,
            'content' => $this->content,
            'due_date' => $this->due_date,
            'is_success' => $this->is_success,
            'priority' => $this->priority,
            'category_id' => $this->category_id,
        ]);
        $this->dispatch('notify', variant: 'success', message: 'Task berhasil ditambahkan');
        $this->reset();
        $this->ready_for_create = false;
        $this->dispatch('task-updated');
        Flux::modal('modal-detail-task')->close();
    }
    public function render()
    {
        return view('livewire.components.modal.detail-task');
    }
}
