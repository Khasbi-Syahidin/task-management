<?php

namespace App\Livewire\Components;

use App\Models\Task;
use Flux\Flux;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class TaskCard extends Component
{
    public $id;
    public $content;
    public $tag;
    public $category;
    public $is_edit = false;
    public $is_success = false;

    protected $rules = [
        'content' => 'required',
    ];

    protected $messages = [
        'content.required' => 'Task harus diisi',
    ];

    public function mount($task)
    {
        $this->id = $task->id;
        $this->content = $task->content;
        $this->tag = $task->tag->name;
        $this->category = $task->category;
    }

    public function updated()
    {
        $this->validate();
    }

    public function updatedIsSuccess()
    {
        $this->is_edit = false;
        $task = Task::find($this->id);
        $task->status = 'done';
        $task->save();
        $this->dispatch('notify', variant: 'success', message: 'Task Selesai');
        $this->dispatch('task-updated');
    }

    public function save()
    {
        $this->validate();
        $task = Task::find($this->id);
        $task->content = $this->content;
        $task->save();
        $this->is_edit = false;
        $this->dispatch('notify', variant: 'success', message: 'Task berhasil diupdate');
    }

    public function handleEdit()
    {
        $this->is_edit = !$this->is_edit;
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
