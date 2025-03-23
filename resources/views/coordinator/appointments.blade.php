<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>
    <div class="mx-auto max-w-7xl py-10 px-4 2xl:px-0">
        <h1 class="text-xl font-semibold text-gray-600 uppercase">Appointments</h1>
        <div class="mt-5">
            <livewire:coordinator.coordinator-appointment />
        </div>
    </div>
</x-app-layout>
