<div>
    <div class="grid 2xl:grid-cols-4 grid-cols-1 gap-5">
        @forelse ($events as $item)
            <div class="border p-5 rounded-3xl bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-calendar-range text-gray-600">
                    <rect width="18" height="18" x="3" y="4" rx="2" />
                    <path d="M16 2v4" />
                    <path d="M3 10h18" />
                    <path d="M8 2v4" />
                    <path d="M17 14h-6" />
                    <path d="M13 18H7" />
                    <path d="M7 14h.01" />
                    <path d="M17 18h.01" />
                </svg>
                <p class="text-xl mt-2 font-semibold uppercase text-main">{{ $item->name }}</p>
                <div class="mt-4">
                    <x-button label="Get Appointment" slate
                        href="{{ route('client.get-appointment', ['id' => $item->id]) }}" />
                </div>

            </div>
        @empty
        @endforelse
    </div>
</div>
