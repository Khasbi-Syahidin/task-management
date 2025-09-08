<?php


namespace App\Livewire\Components;

use App\Models\Task as ModelsTask;
use Carbon\Carbon;
use Flux\Flux;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class TaskList extends Component
{
    public ?array $filterDate = [
        'start' => null,
        'end' => null,
    ];
    public ?bool $is_success = null;
    public ?int $category_id = null;

    public $perPage = 3;

    #[Computed()]
    public function loadData()
    {
        return ModelsTask::queryBase($this->is_success, $this->filterDate, $this->category_id, $this->perPage);
    }

    #[On('task-updated')]
    public function getLoadData()
    {
        return $this->loadData();
    }

    #[On('change-filter-date')]
    public function setFilterDate($date)
    {
        if ($date === 'this-week') {
            $now = Carbon::now();
            $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
            $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
            $this->filterDate = [
                'start' => $weekStartDate,
                'end' => $weekEndDate,
            ];
        } else {
            $this->filterDate = [
                'start' => now()->startOfDay(),
                'end' => now()->endOfDay(),
            ];
        }
    }
    #[On('change-filter-status')]
    public function setFilterStatus($status)
    {
        $this->is_success = $status;
    }

    #[On('change-filter-category')]
    public function setFilterCategory($category_id)
    {
        $this->category_id = Crypt::decryptString($category_id);
    }

    public function loadMore()
    {
        $this->perPage += 3;
    }

    public function render()
    {
        return view('livewire.components.task-list');
    }
}
