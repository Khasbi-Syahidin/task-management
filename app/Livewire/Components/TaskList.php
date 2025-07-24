<?php


namespace App\Livewire\Components;

use App\Models\Task as ModelsTask;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskList extends Component
{
    public $tasks;

    public function mount()
    {
        $this->loadData();
    }

    #[On('task-updated')]
    public function loadData()
    {
        $this->tasks = ModelsTask::select('id', 'content', 'tag_id', 'category')->where('status', 'todo')->orderBy('created_at', 'desc')->with('tag')->get();
    }
    public function render()
    {
        return view('livewire.components.task-list');
    }
}
