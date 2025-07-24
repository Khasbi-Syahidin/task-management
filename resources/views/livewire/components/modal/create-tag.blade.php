 <flux:modal @cancel="resetTagId" name="modal-create-tag" class="w-full max-w-sm">
     <div class="space-y-6">
         <div>
             <flux:heading size="lg">Tambahkan Tag</flux:heading>
         </div>
         <flux:input wire:model.live.debounce="name" autofocus wire:keydown.enter="save" placeholder="Nama Tag" />
         <div class="flex">
             <flux:spacer />
             <flux:button wire:click="save" variant="primary">Simpan</flux:button>
         </div>
     </div>
 </flux:modal>
