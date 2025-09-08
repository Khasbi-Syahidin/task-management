<div class="">
    <div class="flex flex-col m-auto justify-center items-center">
        <div class="content max-w-xl mx-auto h-fit w-full flex flex-col gap-4">
            <div
                class="flex flex-col gap-3 rounded-2xl border border-neutral-300 dark:border-neutral-600 p-6 w-full h-fit sticky top-10 bg-white dark:bg-neutral-900 shadow-lg z-10">
                <div class="flex flex-col md:flex-row gap-3">
                    <div
                        class="flex border border-neutral-300 dark:border-neutral-600 rounded-xl overflow-hidden w-full">
                        <flux:input wire:model.live.debounce="title" class="w-full" placeholder="Tulis Agenda di sini"
                            class=" !border-none !rounded-none !focus:ring-0" />
                    </div>
                    <div class="hidden md:flex">
                        <flux:button wire:click="save" icon="plus" color="green" variant="primary"
                            :disabled="!$ready_for_create" class=" disabled:bg-primary/80 disabled:cursor-not-allowed">
                            Tambah
                        </flux:button>
                    </div>
                </div>
                @if ($errors->has('title'))
                    <div class="text-sm text-red-500">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <div class="priority">
                    <flux:radio.group wire:model.live.debounce="priority" label="Priority" variant="buttons"
                        class="w-full *:flex-1">
                        <flux:radio value="high" icon="exclamation-triangle" class="text-red-500">High</flux:radio>
                        <flux:radio value="medium" icon="exclamation-circle" class="text-red-500">Medium
                        </flux:radio>
                        <flux:radio value="low" icon="bell" class="text-red-500">Low</flux:radio>
                    </flux:radio.group>
                </div>
                <flux:accordion transition>
                    <flux:accordion.item>
                        <div class="p-3 flex-col rounded-lg border border-gray-600/20  dark:bg-neutral-800 shadow-sm">
                            <flux:accordion.heading>Tambahkan detail</flux:accordion.heading>
                            <flux:accordion.content>
                                <div
                                    class="grid grid-cols-2 gap-3 p-4 pt-6 rounded-lg bg-neutral-100 dark:bg-neutral-800">
                                    <div class="w-full col-span-2 md:col-span-1">
                                        <flux:date-picker wire:model.live.debounce="due_date" label="Due date" />
                                    </div>
                                    <div class="w-full col-span-2 md:col-span-1 relative">
                                        <button class="bg-primary rounded-lg absolute -top-1 right-2 cursor-pointer">
                                            <flux:icon name="plus" wire:click="createCategory"
                                                class="!text-white !w-5 !h-5" />
                                        </button>
                                        <flux:select wire:model.live.debounce="category_id" variant="listbox"
                                            label="Kategori" placeholder="Pilih Kategori...">
                                            @foreach ($categories as $category)
                                                <flux:select.option value="{{ $category['id'] }}">
                                                    {{ $category['name'] }}
                                                </flux:select.option>
                                            @endforeach
                                            @if (count($categories) === 0)
                                                <flux:select.option disabled>Belum ada kategori, silahkan tambah
                                                    terlebih dahulu..</flux:select.option>
                                            @endif
                                        </flux:select>
                                    </div>
                                    <div class="!col-span-2 !w-full">
                                        <flux:textarea wire:model.live.debounce="content" class="!col-span-2 !w-full"
                                            label="Deskripsi" />
                                    </div>
                                </div>
                            </flux:accordion.content>
                        </div>
                    </flux:accordion.item>
                </flux:accordion>
                <div class="w-full md:hidden">
                    <flux:button wire:click="save" icon="plus" color="green" variant="primary"
                        :disabled="!$ready_for_create"
                        class="disabled:bg-primary/80 disabled:cursor-not-allowed w-full">
                        Tambah
                    </flux:button>
                </div>
            </div>
            <livewire:components.task-list>
        </div>


        <livewire:components.modal.filter-task />

        {{-- modal create task --}}

        <livewire:components.modal.create-category>
            <livewire:components.modal.detail-task>

                {{-- confirm delete Task --}}
                <livewire:components.modal.confirm-delete-task />

                {{-- button show filter --}}
                <flux:button icon='funnel' variant="primary" wire:click='showFilter'
                    class="!fixed bottom-10 right-10 md:!bottom-20 md:!right-20 lg:!bottom-15 lg:!right-15"
                    color="blue">Tampilkan Filter
                </flux:button>
    </div>
</div>
