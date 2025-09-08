 <flux:modal
     @cancel="resetTask" name="modal-detail-task" class="w-full max-w-lg">
     <div class="space-y-6">
         <div>
             <flux:heading size="lg">Detail Task</flux:heading>
         </div>
          <div class="grid grid-cols-2 gap-3 pt-4">
            <div class="!col-span-2 !w-full">
         <flux:input wire:model.live.debounce="title" autofocus wire:keydown.enter="save" placeholder="Title" />
     </div>
     <div class="!col-span-2 !w-full">
         <flux:textarea wire:model.live.debounce="content" class="!col-span-2 !w-full" label="Deskripsi" />
     </div>
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
                                                terlebih dahulu..</flux:select.option> @endif
     </flux:select>
     </div>
     </div>

     <div class="flex gap-2">
         <flux:spacer />
         <flux:modal.close>
             <flux:button variant="outline">Batal</flux:button>
         </flux:modal.close>
         <flux:button wire:click="save" variant="primary" class="bg-primary text-white">Simpan</flux:button>
     </div>
     </div>
 </flux:modal>
