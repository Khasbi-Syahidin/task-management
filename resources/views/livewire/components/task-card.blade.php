@php
    $color = match ($priority) {
        'high' => 'red',
        'medium' => 'blue',
        'low' => 'purple',
        default => 'zinc',
    };
@endphp

<div class="flex flex-col gap-2" wire:click="detailTask({{ $id }})" wire:ignore.self>
    <div
        class="card w-full h-fit rounded-2xl border dark:border-neutral-700 border-neutral-300  bg-white dark:bg-neutral-900  0 flex flex-col gap-3 p-6 shadow-lg">
        <div class="flex gap-2 items-center py-2">
            <flux:checkbox wire:click.stop wire:model.live="is_success" />
            @if ($is_edit)
                <flux:textarea rows="2" class="border" wire:click.stop wire:model.live="title"
                    wire:keydown.enter="save" wire:ignore />
            @else
                <flux:text class=" text-xl font-bold truncate">{{ $title }} </flux:text>
            @endif
        </div>
        <hr class="border dark:border-neutral-700 border-dashed">
        <flux:accordion wire:click.stop transition>
            <flux:accordion.item class="flex flex-col gap-3">
                <flux:accordion.heading>Lihat Detail</flux:accordion.heading>
                <flux:accordion.content class="flex flex-col gap-3">
                    <div
                        class="flex flex-col gap-4 justify-start capitalize pt-2 bg-neutral-100 dark:bg-neutral-800 p-3 rounded-lg ">
                        @php
                            $priorityColors = [
                                'high' => 'bg-red-500',
                                'medium' => 'bg-yellow-500',
                                'low' => 'bg-green-500',
                            ];

                            $bgColor = $priorityColors[$priority] ?? 'bg-zinc-500';
                        @endphp

                        <div class="flex gap-2 items-center">
                            <div class="p-2 rounded-lg {{ $bgColor }}">
                                <flux:icon name="exclamation-triangle" class="text-white size-4" />
                            </div>
                            <flux:text class="font-bold">{{ $priority }}</flux:text>
                        </div>

                        @if ($due_date != null)
                            <div class="flex gap-2 items-center">
                                <div class="p-2 rounded-lg bg-primary">
                                    <flux:icon name="calendar" class="text-white size-4" />
                                </div>
                                <flux:text class="font-bold">{{ \Carbon\Carbon::parse($due_date)->format('j F Y') }}
                                </flux:text>
                            </div>
                        @endif
                        @if ($category_id)
                            <div wire:show="category_id" class="flex gap-2 items-center">
                                <div class="p-2 rounded-lg bg-primary">
                                    <flux:icon name="home" class="text-white size-4" />
                                </div>
                                <flux:text class="font-bold">{{ $category->name }}</flux:text>
                            </div>
                        @endif
                    </div>
                    <div class="actions flex justify-end gap-2">
                        <flux:button size="sm" icon="pencil-square" color="green"
                            :variant="match($is_edit) {
                                true => 'primary',
                                    false => 'outline'
                            }"
                            wire:click.stop="handleEdit" />

                        <flux:button size="sm" icon="trash" wire:click.stop="confirmDelete({{ $id }})"
                            color="red" variant="outline" />
                    </div>
                </flux:accordion.content>
            </flux:accordion.item>
        </flux:accordion>
    </div>
</div>
