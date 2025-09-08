<div>
    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        {{-- <a href="{{ route('home') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a> --}}

        <flux:navlist variant="outline">
            <flux:navlist.item icon="bookmark" :href="route('home', ['date' => 'today'])"
                :current="request()->routeIs('home') && request()->query('date') === 'today'" badge="2"
                wire:navigate >{{ __('Hari Ini') }}</flux:navlist.item>
            <flux:navlist.item icon="bookmark-square" :href="route('home', ['date' => 'this_week'])"
                :current="request()->routeIs('home') && request()->query('date') === 'this_week'" badge="1"
                wire:navigate>{{ __('7 Hari Terakhir') }}</flux:navlist.item>
        </flux:navlist>
        <hr class="border-0 h-[1px] bg-neutral-600">
        @if ($this->loadCategories()->count() > 0)
            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Kategori')" class="grid">
                    @foreach ($this->loadCategories() as $category)
                        <flux:navlist.item icon="home" :href="route('home', ['category_id' => $category->id])"
                            :current="request()->routeIs('home') && request()->query('category_id') == $category->id"
                            badge="3" wire:navigate>{{ $category->name }}</flux:navlist.item>
                    @endforeach
                </flux:navlist.group>
            </flux:navlist>
            <hr class="border-0 h-[1px] bg-neutral-600">
        @endif

        <flux:navlist variant="outline">
            <flux:navlist.group class="grid">
                <flux:navlist.item icon="document-check" :href="route('home', ['is_success' => 'true'])"
                    :current="request()->routeIs('home') && request()->query('is_success') === 'true'"
                    badge="3" wire:navigate>{{ __('Selesai') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>
        <flux:spacer />
    </flux:sidebar>
</div>
