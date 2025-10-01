@livewireStyles

<x-layouts.app.header :title="$title ?? null">
</x-layouts.app.header>

<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
