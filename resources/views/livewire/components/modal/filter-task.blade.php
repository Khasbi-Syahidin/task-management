<flux:modal name="modal-show-filter" variant="flyout">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Terapkan Filter</flux:heading>
            <flux:text class="mt-2">Lebih Mudah Temukan Task dengan Filter</flux:text>
        </div>
        <div class="status">
            <flux:radio.group wire:model.live.debounce="is_success" label="Status" variant="cards" class="max-sm:flex-col">
                <flux:radio value="1" label="Selesai" />
                <flux:radio value="0" label="Belum Selesai" />
            </flux:radio.group>
        </div>
        <div class="filterDate">
            <flux:radio.group wire:model.live.debounce="filterDate" label="Scope Waktu" variant="cards"
                class="max-sm:flex-col">
                <flux:radio value="today" label="Hari Ini" />
                <flux:radio value="this-week" label="Minggu Ini" />
            </flux:radio.group>
        </div>
        <flux:select wire:model.live.debounce="category_id" variant="listbox" placeholder="Pilih Kategori Tugas..."
            label="Kategori Tugas">
            @forelse ($this->loadCategories as $category)
                <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
            @empty
                <flux:select.option>Data Kategori Masih Kosong</flux:select.option>
            @endforelse
        </flux:select>
        <div class="flex flex-col gap-3">
            <flux:spacer />
            <flux:button wire:click='resetData' type="submit" variant="outline" class="w-full">Reset</flux:button>
            <flux:button wire:click='save' type="submit" variant="primary" class="w-full bg-primary text-white">
                Terapkan
            </flux:button>
        </div>
    </div>
</flux:modal>
