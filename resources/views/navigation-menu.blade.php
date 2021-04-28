<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/">
                        <img class="block h-9 w-auto" src="/logo.png" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" :active="request()->routeIs('*.dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
                    @if(Auth::user()->isAdmin() && request()->is('admin/*'))
                        @unless(Auth::user()->isEditor())
                        <x-jet-nav-link href="{{ route('customers.index') }}" :active="request()->routeIs('customers.*')">
                            {{ __('Customers') }}
                        </x-jet-nav-link>
                        <x-nav-dropdown-parent :active="request()->routeIs('orders.*') || request()->routeIs('returns.*')">
                            <x-slot name="name">
                                {{ __('Orders') }}
                            </x-slot>
                            <x-slot name="children">
                                <a href="{{ route('orders.index') }}">{{ __('Orders') }}</a>
                                <a href="{{ route('refunds.index') }}">{{ __('Returns') }}</a>
                                <a href="{{ route('refunds.create') }}">{{ __('Create a return') }}</a>
                            </x-slot>
                        </x-nav-dropdown-parent>
                        @endunless
                        <x-nav-dropdown-parent :active="request()->routeIs('books.*') || request()->routeIs('authors.*') || request()->routeIs('categories.*')">
                            <x-slot name="name">
                                {{ __('Bookstore') }}
                            </x-slot>
                            <x-slot name="children">
                                <a href="{{ route('books.index') }}">{{ __('List of books') }}</a>
                                <a href="{{ route('books.create') }}">{{ __('Add a book') }}</a>
                                <a href="{{ route('authors.index') }}">{{ __('List of authors') }}</a>
                                <a href="{{ route('authors.create') }}">{{ __('Add an author') }}</a>
                                <a href="{{ route('categories.index') }}">{{ __('List of categories') }}</a>
                                <a href="{{ route('categories.create') }}">{{ __('Add a category') }}</a>
                            </x-slot>
                        </x-nav-dropdown-parent>
                        @unless(Auth::user()->isEditor())
                        <x-nav-dropdown-parent :active="request()->routeIs('users.*')">
                            <x-slot name="name">
                                {{ __('Users') }}
                            </x-slot>
                            <x-slot name="children">
                                <a href="{{ route('users.index') }}">{{ __('List of users') }}</a>
                                <a href="{{ route('users.create') }}">{{ __('Add user') }}</a>
                            </x-slot>
                        </x-nav-dropdown-parent>
                        <x-nav-dropdown-parent :active="request()->routeIs('shipping-methods.*') || request()->routeIs('contact.*')">
                            <x-slot name="name">
                                {{ __('Administration') }}
                            </x-slot>
                            <x-slot name="children">
                                <a href="{{ route('shipping-methods.index') }}">{{ __('List of shipping methods') }}</a>
                                <a href="{{ route('shipping-methods.create') }}">{{ __('Add a shipping method') }}</a>
                                <a href="{{ route('contact.index') }}">{{ __('Contact forms') }}</a>
                                <a href="#">{{ __('Reports') }}</a>
                            </x-slot>
                        </x-nav-dropdown-parent>
                        @endunless
                    @endif
                    @if (Auth::user()->role == 0 || request()->is('user/*'))
                        <x-nav-dropdown-parent :active="request()->routeIs('methods.*')">
                            <x-slot name="name">
                                {{ __('Payment methods') }}
                            </x-slot>
                            <x-slot name="children">
                                <a href="{{ route('methods.index') }}">{{ __('Your payment methods') }}</a>
                                <a href="{{ route('methods.create') }}">{{ __('Add a payment method') }}</a>
                            </x-slot>
                        </x-nav-dropdown-parent>
                        <x-jet-nav-link href="{{ route('user.orders') }}" :active="request()->routeIs('user.order*')">{{ __('Orders') }}</x-jet-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Auth::user()->isAdmin())
                                <x-jet-dropdown-link href="{{ route('user.dashboard') }}">
                                    {{ __('Act as user') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('admin.dashboard') }}">
                                    {{ __('Act as admin') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" :active="request()->routeIs('*.dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
