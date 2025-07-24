<div class="flex flex-col m-auto justify-center items-center">
    <div class="content max-w-lg mx-auto h-fit w-full flex flex-col gap-4">
        <div
            class="flex flex-col gap-3 rounded-2xl border border-neutral-300 dark:border-neutral-600 p-6 w-full h-fit sticky top-10 bg-neutral-100 dark:bg-neutral-900 z-10">
            <div class="flex flex-col md:flex-row gap-3">
                <div class="flex border border-neutral-300 dark:border-neutral-600 rounded-xl overflow-hidden w-full">
                    <flux:input wire:model.live.debounce="content" class="w-full" placeholder="Tulis Agenda di sini"
                        class=" !border-none !rounded-none !focus:ring-0" />
                    <flux:select wire:model.live.debounce="tag_id" placeholder="Tag"
                        class="max-w-20 !bg-neutral-900 dark:!bg-neutral-200 dark:!text-black !text-white border-none rounded-none">
                        <div class="flex flex-col gap-3">
                            @foreach ($tags as $tag)
                                <flux:select.option :key="$tag->id" value="{{ $tag->id }}">
                                    {{ $tag->name }}</flux:select.option>
                            @endforeach
                        </div>
                        <flux:select.option selected value="0">Tambah Tag</flux:select.option>
                    </flux:select>
                </div>
                <div class="hidden md:flex">
                    <flux:button wire:click="save" icon="plus" color="green" variant="primary"
                        :disabled="!$ready_for_create" class=" disabled:bg-primary/80 disabled:cursor-not-allowed">
                        Tambah
                    </flux:button>
                </div>
            </div>
            <div class="priority">
                <flux:radio.group wire:model.live.debounce="category" class="flex gap-3 items-center ">
                    <flux:radio value="hight" label="Hight" checked
                        class="my-auto flex justify-center items-center" />
                    <flux:radio value="medium" label="Medium" class="my-auto flex justify-center items-center" />
                    <flux:radio value="low" label="Low" class="my-auto flex justify-center items-center" />
                </flux:radio.group>
            </div>
            <div class="w-full md:hidden">
                <flux:button wire:click="save" icon="plus" color="green" variant="primary"
                    :disabled="!$ready_for_create" class="disabled:bg-primary/80 disabled:cursor-not-allowed w-full">
                    Tambah
                </flux:button>
            </div>
        </div>
        <livewire:components.task-list>
    </div>

    {{-- modal create task --}}

    <livewire:components.modal.create-tag>

        {{-- confirm delete Task --}}


        <livewire:components.modal.confirm-delete-task />

</div>
