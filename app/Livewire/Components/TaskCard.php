<?php

namespace App\Livewire\Components;

use App\Models\Task;
use Flux\Flux;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class TaskCard extends Component
{
    //integer
    public $id;
    //string
    public $title, $content;
    // public $content;
    public $priority;
    public $due_date = null;
    public $category_id = null;
    public $category = null;
    public $is_edit = false;
    public $is_success = false;

    protected $rules = [
        'title' => 'required|string',
    ];

    protected $messages = [
        'title.string' => 'Judul harus berupa teks',
    ];

    public function mount($task)
    {
        $this->id = $task->id;
        $this->title = $task->title;
        $this->is_success = $task->is_success;
        $this->priority = $task->priority;
        $this->category_id = $task->category_id;
        $this->category = $task->category;
        $this->due_date = $task->due_date;
    }

    public function updated()
    {
        $this->validate();
    }

    public function updatedIsSuccess()
    {
        $this->is_edit = false;
        $task = Task::find($this->id);
        $task->is_success = $this->is_success;
        $task->save();
        $this->dispatch('notify', variant: 'success', message: 'Task Selesai');
        $this->dispatch('task-updated');
    }

    public function save()
    {
        $this->validate();
        $task = Task::find($this->id);
        $task->title = $this->title;
        $task->save();
        $this->is_edit = false;
        $this->dispatch('notify', variant: 'success', message: 'Task berhasil diupdate');
    }

    public function handleEdit()
    {
        $this->is_edit = !$this->is_edit;
    }

    public function detailTask($id)
    {
        Flux::modal('modal-detail-task')->show();
        $this->dispatch('detail-task', id: $id);
    }

    public function confirmDelete($id)
    {
        Flux::modal('confirm-delete-task')->show();
        $this->dispatch('delete-task', id: $id);
    }

    public function render()
    {
        return view('livewire.components.task-card');
    }
}
