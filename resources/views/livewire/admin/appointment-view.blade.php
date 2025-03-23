<div>
    <div class="border rounded-2xl ">

        <div class="px-5 pt-5 ">
            <x-button label="Back" icon="arrow-left" slate class="font-bold uppercase"
                href="{{ route('admin.appointments') }}" />
        </div>
        <div class="border-b px-5 py-5 flex justify-between items-center">
            <div>
                <span class="text-sm">{{ $appointment->created_at->format('F d, Y') }}</span>
                <div class="mt-3">
                    <span
                        class="bg-blue-100 text-blue-800  font-semibold px-2.5 py-0.5 rounded-full">{{ $appointment->event->name }}</span>
                </div>
            </div>
            <div class="flex space-x-2 items-center">
                @if ($appointment->status == 'pending')
                    <x-button wire:click="approve" spinner="approve" label="Approve" icon="hand-thumb-up" squared
                        outline class="font-semibold uppercase" positive />
                    <x-button wire:click="reject" spinner="reject" label="Reject" icon="hand-thumb-down" squared outline
                        class="font-semibold uppercase" negative />
                @endif
            </div>
        </div>
        @switch($appointment->event_id)
            @case(1)
                <div class="border-b">
                    <div class="p-5">
                        <h1 class="text-lg font-bold text-gray-700">INFORMATION</h1>
                        <div class="mt-5 grid grid-cols-5 gap-5">
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Firstname</span>
                                <h1 class="leading-3">{{ $client_name }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">HOST PASTOR</span>
                                <h1 class="leading-3">{{ $host_pastor }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">reception</span>
                                <h1 class="leading-3">{{ $reception }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">contact number</span>
                                <h1 class="leading-3">{{ $contact_number }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">scheduled practice</span>
                                <h1 class="leading-3">{{ \Carbon\Carbon::parse($scheduled_practice)->format('F, d Y') }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">grooms name</span>
                                <h1 class="leading-3">{{ $groom_name }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">brides name</span>
                                <h1 class="leading-3">{{ $bride_name }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Coordinator</span>
                                @foreach ($coordinator as $item)
                                    @php
                                        $data = \App\Models\Coordinator::where('id', $item)->first();
                                    @endphp
                                    <h1 class="leading-3">{{ $data->lastname . ', ' . $data->firstname }}</h1>
                                @endforeach
                            </div>
                            <div class="col-span-2">

                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">SONGS</span>
                                <div class="space-y-2">
                                    @foreach ($songs as $item)
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">SINGERS</span>
                                <div class="space-y-2">
                                    @foreach ($singers as $item)
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="border-b">
                    <div class="p-5">
                        <h1 class="text-lg font-bold text-gray-700">PRINCIPAL SPONSORS</h1>
                        <div class="mt-5 grid grid-cols-5 gap-5">
                            @forelse ($principals as $item)
                                <div>
                                    <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                    <h1 class="leading-3">{{ $item['name'] }}</h1>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="p-5">
                        <h1 class="text-lg font-bold text-gray-700">SECONDARY SPONSORS</h1>
                        <div class="mt-5 grid grid-cols-5 gap-5">
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">OFFICIATING MINISTER</span>
                                <h1 class="leading-3">{{ $officiating_minister }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">RING BEARER</span>
                                <h1 class="leading-3">{{ $ring_bearer }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">BIBLE BEARER</span>
                                <h1 class="leading-3">{{ $bible_bearer }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">COIN BEARER</span>
                                <h1 class="leading-3">{{ $coin_bearer }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">LITTLE GROOM</span>
                                <h1 class="leading-3">{{ $little_groom }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">LITTLE BRIDE</span>
                                <h1 class="leading-3">{{ $little_bride }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">BEST MAN</span>
                                <h1 class="leading-3">{{ $best_man }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">MAID OF HONOR</span>
                                <h1 class="leading-3">{{ $maid_of_honor }}</h1>
                            </div>

                        </div>
                        <div class="mt-10 grid grid-cols-5 gap-5">
                            <div class="col-span-2  grid grid-cols-2 border p-2 gap-5">
                                <div class="col-span-2">
                                    <h1 class="text-gray-600 uppercase underline">TO LIGHT OUR PATH</h1>
                                </div>
                                @forelse ($light_our_path as $item)
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                            <div class="col-span-2  grid grid-cols-2 border p-2 gap-5">
                                <div class="col-span-2">
                                    <h1 class="text-gray-600 uppercase underline">TO CLOTH US ONE</h1>
                                </div>
                                @forelse ($cloth_us_one as $item)
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                            <div class="col-span-2  grid grid-cols-2 border p-2 gap-5">
                                <div class="col-span-2">
                                    <h1 class="text-gray-600 uppercase underline">TO BIND US TOGETHER</h1>
                                </div>
                                @forelse ($bind_us_together as $item)
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                            <div class="col-span-2  grid grid-cols-2 border p-2 gap-5">
                                <div class="col-span-2">
                                    <h1 class="text-gray-600 uppercase underline">flower girls</h1>
                                </div>
                                @forelse ($flower_girls as $item)
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                            <div class="col-span-2  grid grid-cols-2 border p-2 gap-5">
                                <div class="col-span-2">
                                    <h1 class="text-gray-600 uppercase underline">grooms man</h1>
                                </div>
                                @forelse ($grooms_man as $item)
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                            <div class="col-span-2  grid grid-cols-2 border p-2 gap-5">
                                <div class="col-span-2">
                                    <h1 class="text-gray-600 uppercase underline">brides maid</h1>
                                </div>
                                @forelse ($brides_maid as $item)
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                            <div class="col-span-2  grid grid-cols-2 border p-2 gap-5">
                                <div class="col-span-2">
                                    <h1 class="text-gray-600 uppercase underline">GROOMS PARENT</h1>
                                </div>
                                @forelse ($grooms_parent as $item)
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                            <div class="col-span-2  grid grid-cols-2 border p-2 gap-5">
                                <div class="col-span-2">
                                    <h1 class="text-gray-600 uppercase underline">brides parent</h1>
                                </div>
                                @forelse ($brides_parent as $item)
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            @break

            @case(2)
                <div class="border-b">
                    <div class="p-5">
                        <h1 class="text-lg font-bold text-gray-700">INFORMATION</h1>
                        <div class="mt-5 grid grid-cols-5 gap-5">
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Client Name</span>
                                <h1 class="leading-3">{{ $client_name }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Pastor</span>
                                <h1 class="leading-3">{{ $host_pastor }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Location</span>
                                <h1 class="leading-3">{{ $location }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Baby Name</span>
                                <h1 class="leading-3">{{ $baby_name }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Birthdate</span>
                                <h1 class="leading-3">{{ \Carbon\Carbon::parse($birthdate)->format('F d, Y') }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Birthplace</span>
                                <h1 class="leading-3">{{ $birthplace }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Mother Name</span>
                                <h1 class="leading-3">{{ $mother_name }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Father Name</span>
                                <h1 class="leading-3">{{ $father_name }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Coordinator</span>
                                @foreach ($coordinator as $item)
                                    @php
                                        $data = \App\Models\Coordinator::where('id', $item)->first();
                                    @endphp
                                    <h1 class="leading-3">{{ $data->lastname . ', ' . $data->firstname }}</h1>
                                @endforeach
                            </div>
                            <div class="col-span-2  grid grid-cols-2 border p-2 gap-5">
                                <div class="col-span-2">
                                    <h1 class="text-gray-600 uppercase underline">Singer</h1>
                                </div>
                                @forelse ($singers as $item)
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                            <div class="col-span-2  grid grid-cols-2 border p-2 gap-5">
                                <div class="col-span-2">
                                    <h1 class="text-gray-600 uppercase underline">SONGS</h1>
                                </div>
                                @forelse ($songs as $item)
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="p-5">
                        <h1 class="text-lg font-bold text-gray-700">GODPARENTS</h1>
                        <div class="mt-5 grid grid-cols-5 gap-5">
                            <div class="col-span-2  grid grid-cols-2 border p-2 gap-5">
                                <div class="col-span-2">
                                    <h1 class="text-gray-600 uppercase underline"></h1>
                                </div>
                                @forelse ($godparent as $item)
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    </div>

                                @empty
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            @break

            @case(3)
                <div class="border-b">
                    <div class="p-5">
                        <h1 class="text-lg font-bold text-gray-700">INFORMATION</h1>
                        <div class="mt-5 grid grid-cols-5 gap-5">
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Client Name</span>
                                <h1 class="leading-3">{{ $client_name }}</h1>
                            </div>

                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Location</span>
                                <h1 class="leading-3">{{ $location }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Contact Number</span>
                                <h1 class="leading-3">{{ $contact_number }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Music In-Charge</span>
                                <h1 class="leading-3">{{ $music_in_charge }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Program In-Charge</span>
                                <h1 class="leading-3">{{ $program_in_charge }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Date</span>
                                <h1 class="leading-3">{{ \Carbon\Carbon::parse($date)->format('F d, Y') }}</h1>
                            </div>

                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Master of Ceremony</span>
                                <h1 class="leading-3">{{ $master_of_ceremony }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Speaker</span>
                                <h1 class="leading-3">{{ $speaker }}</h1>
                            </div>
                            <div>
                                <span class="text-xs uppercase underline text-gray-500">Coordinator</span>
                                <ul class="space-y-2">
                                    @foreach ($coordinator as $item)
                                        @php
                                            $data = \App\Models\Coordinator::where('id', $item)->first();
                                        @endphp
                                        <h1 class="leading-3">{{ $data->lastname . ', ' . $data->firstname }}</h1>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-span-2  grid grid-cols-2 border p-2 gap-5">
                                <div class="col-span-2">
                                    <h1 class="text-gray-600 uppercase underline">SONGS</h1>
                                </div>
                                @forelse ($songs as $item)
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="p-5">
                        <h1 class="text-lg font-bold text-gray-700">PARTICIPANTS</h1>
                        <div class="mt-5 grid grid-cols-5 gap-5">
                            <div class="col-span-2  grid grid-cols-2 border p-2 gap-5">
                                <div class="col-span-2">
                                    <h1 class="text-gray-600 uppercase underline"></h1>
                                </div>
                                @forelse ($participants as $item)
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">NAME</span>
                                        <h1 class="leading-3">{{ $item['name'] }}</h1>
                                    </div>
                                    <div>
                                        <span class="text-xs uppercase underline text-gray-500">AMOUNT</span>
                                        <h1 class="leading-3">&#8369;{{ number_format($item['amount'], 2) }}</h1>
                                    </div>

                                @empty
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            @break

            @default
        @endswitch
    </div>

</div>
