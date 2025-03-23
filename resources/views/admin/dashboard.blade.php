@section('title', 'Dashboard')
<x-admin-layout>
    <div>
        <div class="grid grid-cols-4 gap-5">
            <div class="border bg-white shadow rounded-xl flex space-x-3 items-center p-5">
                <div class="h-16 w-16 bg-red-500 rounded-full grid place-content-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-hand-heart">
                        <path d="M11 14h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 16" />
                        <path
                            d="m7 20 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                        <path d="m2 15 6 6" />
                        <path
                            d="M19.5 8.5c.7-.7 1.5-1.6 1.5-2.7A2.73 2.73 0 0 0 16 4a2.78 2.78 0 0 0-5 1.8c0 1.2.8 2 1.5 2.8L16 12Z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-semibold text-gray-700">Weddings</h1>
                    <h1 class="text-3xl">{{ \App\Models\WeddingInfo::count() }}</h1>
                </div>
            </div>
            <div class="border bg-white shadow rounded-xl flex space-x-3 items-center p-5">
                <div class="h-16 w-16 bg-orange-500 rounded-full grid place-content-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-droplets">
                        <path
                            d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z" />
                        <path
                            d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-semibold text-gray-700">Baptism</h1>
                    <h1 class="text-3xl">{{ \App\Models\BaptismalInfo::count() }}</h1>
                </div>
            </div>
            <div class="border bg-white shadow rounded-xl flex space-x-3 items-center p-5">
                <div class="h-16 w-16 bg-green-500 rounded-full grid place-content-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-users-round">
                        <path d="M18 21a8 8 0 0 0-16 0" />
                        <circle cx="10" cy="8" r="5" />
                        <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-semibold text-gray-700">Fellowships</h1>
                    <h1 class="text-3xl">{{ \App\Models\FellowShipInfo::count() }}</h1>
                </div>
            </div>
            <div class="border bg-white shadow rounded-xl flex space-x-3 items-center p-5">
                <div class="h-16 w-16 bg-blue-500 rounded-full grid place-content-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-user-search">
                        <circle cx="10" cy="7" r="4" />
                        <path d="M10.3 15H7a4 4 0 0 0-4 4v2" />
                        <circle cx="17" cy="17" r="3" />
                        <path d="m21 21-1.9-1.9" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-semibold text-gray-700">Accounts</h1>
                    <h1 class="text-3xl">{{ \App\Models\User::where('role_id', '!=', 1)->count() }}</h1>
                </div>
            </div>
        </div>
        <div class="mt-10">
            <livewire:admin.dashboard />
        </div>
    </div>
</x-admin-layout>
