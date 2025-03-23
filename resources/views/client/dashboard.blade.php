<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="mx-auto max-w-7xl py-10 px-4 2xl:px-0">
        <livewire:client-dashboard />
    </div>
</x-app-layout>
