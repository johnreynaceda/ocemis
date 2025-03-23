<div class="flex flex-col flex-grow px-4 mt-5 pb-2">
    <nav class="flex-1 space-y-1 ">
        <p class="px-4 pt-4 text-xs font-semibold text-gray-500 uppercase">
            Analytics
        </p>
        <ul>
            <li>
                <a class="{{ request()->routeIs('admin.dashboard') ? 'bg-white text-main' : 'text-gray-700' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm  transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-main font-medium"
                    href="{{ route('admin.dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-layout-dashboard">
                        <rect width="7" height="9" x="3" y="3" rx="1" />
                        <rect width="7" height="5" x="14" y="3" rx="1" />
                        <rect width="7" height="9" x="14" y="12" rx="1" />
                        <rect width="7" height="5" x="3" y="16" rx="1" />
                    </svg>
                    <span class="ml-4"> Dashboard </span>
                </a>
            </li>

        </ul>
        <p class="px-4 pt-10 text-xs font-semibold text-gray-500 uppercase">
            MANAGEMENT
        </p>
        <ul>
            <li>
                <a class=" {{ request()->routeIs('admin.event') ? 'bg-white text-main' : 'text-gray-700' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm  transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-main font-medium"
                    href="{{ route('admin.event') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-calendar-days">
                        <path d="M8 2v4" />
                        <path d="M16 2v4" />
                        <rect width="18" height="18" x="3" y="4" rx="2" />
                        <path d="M3 10h18" />
                        <path d="M8 14h.01" />
                        <path d="M12 14h.01" />
                        <path d="M16 14h.01" />
                        <path d="M8 18h.01" />
                        <path d="M12 18h.01" />
                        <path d="M16 18h.01" />
                    </svg>
                    <span class="ml-4"> Events</span>

                </a>
            </li>
            <li>
                <a class=" {{ request()->routeIs('admin.appointments') ? 'bg-white text-main' : 'text-gray-700' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm  transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-main font-medium"
                    href="{{ route('admin.appointments') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-calendar-clock">
                        <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5" />
                        <path d="M16 2v4" />
                        <path d="M8 2v4" />
                        <path d="M3 10h5" />
                        <path d="M17.5 17.5 16 16.3V14" />
                        <circle cx="16" cy="16" r="6" />
                    </svg>
                    <span class="ml-4"> Appointments</span>

                </a>
            </li>
            <li>
                <a class=" {{ request()->routeIs('admin.billing') ? 'bg-white text-main' : 'text-gray-700' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm  transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-main font-medium"
                    href="{{ route('admin.billing') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-wallet">
                        <path
                            d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1" />
                        <path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4" />
                    </svg>
                    <span class="ml-4"> Payment/Billing</span>

                </a>
            </li>
            <li>
                <a class=" {{ request()->routeIs('admin.records') ? 'bg-white text-main' : 'text-gray-700' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm  transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-main font-medium"
                    href="{{ route('admin.records') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-file-spreadsheet">
                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                        <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                        <path d="M8 13h2" />
                        <path d="M14 13h2" />
                        <path d="M8 17h2" />
                        <path d="M14 17h2" />
                    </svg>
                    <span class="ml-4"> Records</span>

                </a>
            </li>
            <li>
                <a class="{{ request()->routeIs('admin.coordinator') ? 'bg-white text-main' : 'text-gray-700' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm  transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-main font-medium"
                    href="{{ route('admin.coordinator') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-users-round">
                        <path d="M18 21a8 8 0 0 0-16 0" />
                        <circle cx="10" cy="8" r="5" />
                        <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                    </svg>
                    <span class="ml-4"> Coordinators</span>

                </a>
            </li>
            <li>
                <a class="{{ request()->routeIs('admin.users') ? 'bg-white text-main' : 'text-gray-700' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm  transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-main font-medium"
                    href="{{ route('admin.users') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-users-round">
                        <path d="M18 21a8 8 0 0 0-16 0" />
                        <circle cx="10" cy="8" r="5" />
                        <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                    </svg>
                    <span class="ml-4"> Users</span>

                </a>
            </li>
        </ul>

        <ul class="pt-10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <li>
                    <a class=" inline-flex items-center w-full px-4 py-2 mt-1 text-sm   transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-main font-medium"
                        href="route('logout')"
                        onclick="event.preventDefault();
                                this.closest('form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-log-out">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" x2="9" y1="12" y2="12" />
                        </svg>
                        <span class="ml-4"> Logout</span>

                    </a>
                </li>
            </form>
        </ul>

    </nav>

</div>
