 <flux:modal @cancel="resetCategoryId" name="modal-create-category" class="w-full max-w-lg">
     <div class="space-y-6">
         <div>
             <flux:heading size="lg">Tambahkan Kategory</flux:heading>
         </div>
         <flux:input wire:model.live.debounce="name" autofocus wire:keydown.enter="save" placeholder="Nama Kategori" />
         <div class="flex gap-2">
             <flux:spacer />
             <flux:modal.close>
                 <flux:button variant="outline">Batal</flux:button>
             </flux:modal.close>
             <flux:button wire:click="save" variant="primary" class="bg-primary text-white">Simpan</flux:button>
         </div>
     </div>
 </flux:modal>
