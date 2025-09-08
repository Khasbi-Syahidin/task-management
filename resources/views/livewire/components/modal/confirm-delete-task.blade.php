<flux:modal name="confirm-delete-task" class="w-full max-w-sm">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Hapus Task?</flux:heading>

            <flux:text class="mt-2">
                <p>Apakah kamu yakin ingin menghapus task ini?</p>
                <p>Anda tidak dapat mengembalikan task ini.</p>
            </flux:text>
        </div>

        <div class="flex gap-2">
            <flux:spacer />

            <flux:modal.close>
                <flux:button variant="outline">Batal</flux:button>
            </flux:modal.close>

            <flux:button wire:click="delete" variant="danger">Hapus</flux:button>
        </div>
    </div>
</flux:modal>
