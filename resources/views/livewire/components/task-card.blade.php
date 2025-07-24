<div class="flex flex-col gap-2">
    <flux:text class="capitalize" class="text-base font-semibold">Tag: #<span class="capitalize">{{ $tag }}</span>
    </flux:text>
    <div
        class="card w-full h-fit rounded-2xl border border-neutral-300 dark:border-neutral-600 bg-accent-foreground flex flex-col gap-3 p-6">
        <div class="flex justify-between capitalize">
            <flux:badge size="sm" class="p-1"
                :color="match($category) {
                    'hight' => 'red',
                    'medium' => 'blue',
                    'low' => 'purple',
                    default => 'zinc',
                }">
                {{ $category }}
            </flux:badge>
            <div class="actions flex gap-2">
                <flux:button size="sm" icon="pencil-square" color="green"
                    :variant="match($is_edit) {
                        true => 'primary',
                            false => 'outline'
                    }"
                    wire:click="handleEdit" />
                <flux:button size="sm" icon="trash" wire:click="confirmDelete({{ $id }})"
                    color="red" variant="outline" />
            </div>
        </div>
        <div class="flex gap-2">
            <input type="checkbox" wire:model.live="is_success" class="w-5 h-5 checked:bg-primary">
            @if ($is_edit)
                <flux:textarea rows="2" class="border" wire:model.live="content" wire:keydown.enter="save" />
            @else
                <flux:text>{{ $content }} </flux:text>
            @endif
        </div>
    </div>
</div>
