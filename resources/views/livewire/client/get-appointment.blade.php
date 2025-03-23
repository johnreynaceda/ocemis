<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($event_name) }}
        </h2>
    </x-slot>

    <div>
        @switch($event_id)
            @case(1)
                <livewire:client.wedding-appointment />
            @break

            @case(2)
                <livewire:baptismal-appointment />
            @break

            @case(3)
                <livewire:client.fellow-ship-appointment />
            @break

            @default
        @endswitch
    </div>
</div>
