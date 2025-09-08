<?php

namespace App\Livewire\Components;

use Livewire\Attributes\Computed;
use Livewire\Component;

class TaskSidebarFilter extends Component
{
    #[Computed()]
    public function loadCategories()
    {
        return \App\Models\CategoryTask::select('id', 'name')->get();
    }
    public function render()
    {
        return view('livewire.components.task-sidebar-filter');
    }
}
