<?php

namespace App\Livewire\Pages;

use App\Models\Task as ModelsTask;
use App\Models\TaskTag;
use Flux\Flux;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Task extends Component
{

    public $content;
    public $category;
    public $tag_id = null;
    public $tags = [];
    public $tasks = [];
    public $ready_for_create = false;

    protected $rules = [
        'content' => 'required',
        'category' => 'required',
        'tag_id' => 'required',
    ];

    protected $messages = [
        'content.required' => 'Task harus diisi',
        'category.required' => 'Category harus diisi',
        'tag_id.required' => 'Tag harus diisi',
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function updatedTagId()
    {
        if ($this->tag_id == 0) {
            $this->createTag();
        }
    }

    #[On('set-tag')]
    public function setTag($tag_id)
    {
        $this->loadTags();
        $this->tag_id = $tag_id;
    }

    public function updated()
    {
        $this->validate();
        if ($this->content && $this->category && $this->tag_id) {
            $this->ready_for_create = true;
        }
    }

    #[On('task-updated')]
    public function loadData()
    {
        $this->loadTags();
        $this->loadTasks();
    }
    public function loadTags()
    {
        $this->tags = TaskTag::select('id', 'name')->get();
    }
    public function loadTasks()
    {
        $this->tasks = ModelsTask::select('id', 'content', 'tag_id', 'category')->orderBy('created_at', 'desc')->with('tag')->get();
    }

    public function createTag()
    {
        Flux::modal('modal-create-tag')->show();
    }
    public function save()
    {
        $this->validate();
        ModelsTask::create([
            'content' => $this->content,
            'category' => $this->category,
            'tag_id' => $this->tag_id,
        ]);
        $this->dispatch('notify', variant: 'success', message: 'Task berhasil ditambahkan');
        $this->reset();
        $this->ready_for_create = false;
        $this->dispatch('task-updated');
    }

    public function render()
    {
        return view('livewire.pages.task')
            ->layout('components.layouts.app', [
                'title' => 'Task Management',
            ]);
    }
}
