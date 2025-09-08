<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

@php
    $categories = App\Models\CategoryTask::select('id', 'name')->withCount('tasks')->get();

@endphp

<body class="min-h-screen bg-white dark:bg-zinc-800 relative">

    {{ $slot }}

    
    <x-toast />

    @if (session('toast'))
        <script>
            document.addEventListener('alpine:init', () => {
                // Jalankan setelah Alpine inisialisasi dan window.toast sudah tersedia
                queueMicrotask(() => {
                    toast(@json(session('toast.message')), {
                        description: @json(session('toast.description')),
                        type: @json(session('toast.type')),
                    });
                });
            });
        </script>
    @endif
    @fluxScripts
</body>

</html>
