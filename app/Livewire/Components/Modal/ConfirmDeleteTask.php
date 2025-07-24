<?php

namespace App\Livewire\Components\Modal;

use App\Models\Task;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class ConfirmDeleteTask extends Component
{
    public $id;

    #[On('delete-task')]
    public function deleteTask($id)
    {
        $this->id = $id;
        Flux::modal('confirm-delete-task')->show();
    }
    public function delete()
    {
        $task = Task::find($this->id);
        $task->delete();
        $this->dispatch('task-updated');
        Flux::modal('confirm-delete-task')->close();
        $this->dispatch('notify', variant: 'success', message: 'Task berhasil dihapus');
    }
    public function render()
    {
        return view('livewire.components.modal.confirm-delete-task');
    }
}
