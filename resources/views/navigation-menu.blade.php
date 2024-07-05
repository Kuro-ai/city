<nav x-data="{ open: false }" class="bg-bgcyan border-b ">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if (auth()->check() && auth()->user()->userRole == 'admin')
                        <div class="flex items-center space-x-8">
                            <x-nav-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
                                {{ __('Chart Dashboard') }}
                            </x-nav-link>

                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="flex text-bbyellow text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                                        <div>Finance</div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link href="{{ route('admin.expenses.index') }}" :active="request()->routeIs('admin.expenses.index')">
                                        {{ __('Expense') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-pale w-40 m-auto"></div>
                                    <x-dropdown-link href="{{ route('admin.incomes.index') }}" :active="request()->routeIs('admin.incomes.index')">
                                        {{ __('Income') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="flex text-bbyellow text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                                        <div>Management</div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link href="{{ route('admin.categories.index') }}" :active="request()->routeIs('admin.categories.index')">
                                        {{ __('Categories') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-pale w-40 m-auto"></div>
                                    <x-dropdown-link href="{{ route('admin.menus.index') }}" :active="request()->routeIs('admin.menus.index')">
                                        {{ __('Menu') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-pale w-40 m-auto"></div>
                                    <x-dropdown-link href="{{ route('admin.tables.index') }}" :active="request()->routeIs('admin.tables.index')">
                                        {{ __('Tables') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-pale w-40 m-auto"></div>
                                    <x-dropdown-link href="{{ route('admin.user.index') }}" :active="request()->routeIs('admin.user.index')">
                                        {{ __('Users') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="flex text-bbyellow text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                                        <div>Order</div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link href="{{ route('admin.reservations.index') }}" :active="request()->routeIs('admin.reservations.index')">
                                        {{ __('Reservation') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-pale w-40 m-auto"></div>
                                    <x-dropdown-link href="{{ route('admin.orders.index') }}" :active="request()->routeIs('admin.orders.index')">
                                        {{ __('Order List') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @elseif (auth()->check() && auth()->user()->userRole == 'manager')
                        <div class="flex items-center space-x-8">
                            <x-nav-link href="{{ route('manager.index') }}" :active="request()->routeIs('manager.index')">
                                {{ __('Chart Dashboard') }}
                            </x-nav-link>

                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="flex text-bbyellow text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                                        <div>Finance</div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link href="{{ route('manager.expenses.index') }}" :active="request()->routeIs('manager.expenses.index')">
                                        {{ __('Expense') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-pale w-40 m-auto"></div>
                                    <x-dropdown-link href="{{ route('manager.incomes.index') }}" :active="request()->routeIs('manager.incomes.index')">
                                        {{ __('Income') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="flex text-bbyellow text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                                        <div>Management</div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link href="{{ route('manager.categories.index') }}" :active="request()->routeIs('manager.categories.index')">
                                        {{ __('Categories') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-pale w-40 m-auto"></div>
                                    <x-dropdown-link href="{{ route('manager.menus.index') }}" :active="request()->routeIs('manager.menus.index')">
                                        {{ __('Menu') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-pale w-40 m-auto"></div>
                                    <x-dropdown-link href="{{ route('manager.tables.index') }}" :active="request()->routeIs('manager.tables.index')">
                                        {{ __('Tables') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-pale w-40 m-auto"></div>
                                    <x-dropdown-link href="{{ route('manager.user.index') }}" :active="request()->routeIs('manager.user.index')">
                                        {{ __('Users') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="flex text-bbyellow text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                                        <div>Order</div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link href="{{ route('manager.reservations.index') }}"
                                        :active="request()->routeIs('manager.reservations.index')">
                                        {{ __('Reservation') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-pale w-40 m-auto"></div>
                                    <x-dropdown-link href="{{ route('manager.orders.index') }}" :active="request()->routeIs('manager.orders.index')">
                                        {{ __('Order List') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @elseif (auth()->check() && auth()->user()->userRole == 'cashier')
                        <div class="flex items-center space-x-8">
                            <x-nav-link href="{{ route('cashier.index') }}" :active="request()->routeIs('cashier.index')">
                                {{ __('Chart Dashboard') }}
                            </x-nav-link>

                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="flex text-bbyellow text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                                        <div>Finance</div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link href="{{ route('cashier.expenses.index') }}" :active="request()->routeIs('cashier.expenses.index')">
                                        {{ __('Expense') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-pale w-40 m-auto"></div>
                                    <x-dropdown-link href="{{ route('cashier.incomes.index') }}" :active="request()->routeIs('cashier.incomes.index')">
                                        {{ __('Income') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="flex text-bbyellow text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                                        <div>Order</div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link href="{{ route('cashier.reservations.index') }}"
                                        :active="request()->routeIs('cashier.reservations.index')">
                                        {{ __('Reservation') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-pale w-40 m-auto"></div>
                                    <x-dropdown-link href="{{ route('cashier.orders.index') }}" :active="request()->routeIs('cashier.orders.index')">
                                        {{ __('Order List') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @elseif (auth()->check() && auth()->user()->userRole == 'staff')
                        <div class="flex items-center space-x-8">
                            <x-nav-link href="{{ route('staff.reservations.index') }}" :active="request()->routeIs('staff.reservations.index')">
                                {{ __('Reservation') }}
                            </x-nav-link>
                            <x-nav-link href="{{ route('staff.orders.index') }}" :active="request()->routeIs('staff.orders.index')">
                                {{ __('Order List') }}
                            </x-nav-link>
                        </div>
                    @else
                        <x-nav-link href="{{ route('customer.index') }}" :active="request()->routeIs('customer.index')">
                            {{ __('Home') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('customer.menus.index') }}" :active="request()->routeIs('customer.menus.index')">
                            {{ __('Our Menu') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('customer.reservations.step.one') }}" :active="request()->routeIs('customer.reservations.step.one')">
                            {{ __('Reservation') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('customer.historylist.index') }}" :active="request()->routeIs('customer.historylist.index')">
                            {{ __('History') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-pale transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}"
                                        alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-pale bg-bgcyan hover:text-pale focus:outline-none  active:bg-bgcyan transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-bbyellow">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-pale hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link> --}}
            @if (auth()->check() && auth()->user()->is_admin)
                <x-responsive-nav-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
                    {{ __('Admin Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.expenses.index') }}" :active="request()->routeIs('admin.expenses.index')">
                    {{ __('Expense') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.incomes.index') }}" :active="request()->routeIs('admin.incomes.index')">
                    {{ __('Income') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.categories.index') }}" :active="request()->routeIs('admin.categories.index')">
                    {{ __('Categories') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.menus.index') }}" :active="request()->routeIs('admin.menus.index')">
                    {{ __('Menu') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.tables.index') }}" :active="request()->routeIs('admin.tables.index')">
                    {{ __('Tables') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.user.index') }}" :active="request()->routeIs('admin.user.index')">
                    {{ __('Users') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.reservations.index') }}" :active="request()->routeIs('admin.reservations.index')">
                    {{ __('Reservation') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.orders.index') }}" :active="request()->routeIs('admin.orders.index')">
                    {{ __('Order List') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link href="{{ route('customer.index') }}" :active="request()->routeIs('customer.index')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('customer.menus.index') }}" :active="request()->routeIs('customer.menus.index')">
                    {{ __('Our Menu') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('customer.reservations.step.one') }}" :active="request()->routeIs('customer.reservations.step.one')">
                    {{ __('Reservation') }}
                </x-responsive-nav-link>
                {{-- <x-responsive-nav-link href="{{ route('customer.categories.index') }}" :active="request()->routeIs('customer.categories.index')">
                    {{ __('Categories') }}
                </x-responsive-nav-link> --}}
                <x-responsive-nav-link href="{{ route('customer.historylist.index') }}" :active="request()->routeIs('customer.historylist.index')">
                    {{ __('History') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
