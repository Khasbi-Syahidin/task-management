<div class="flex flex-col gap-3">
    @forelse ($tasks as $task)
        <livewire:components.task-card :task="$task" :key="$task->id" />
    @empty
        <div
            class="w-full h-fit flex flex-col rounded-lg border border-neutral-300 dark:border-neutral-600 p-6 text-center">
            <flux:text>Belum ada agenda, silahkan tambah terlebih dahulu..</flux:text>
        </div>
    @endforelse
</div>
