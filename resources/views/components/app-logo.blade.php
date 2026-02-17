@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="Implantex" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <img src="{{ asset('icon/favicon.ico') }}" alt="Implantex" {{ $attributes }} style="width: 20px; height: 20px; object-fit: contain;">
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="Implantex" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <img src="{{ asset('icon/favicon.ico') }}" alt="Implantex" {{ $attributes }} style="width: 20px; height: 20px; object-fit: contain;">
        </x-slot>
    </flux:brand>
@endif
