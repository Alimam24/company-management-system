<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <img class="size-8"
                        src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company">
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->


                        @auth
                            <x-nav-link href="/" :active="request()->is('/')" type='a'>Home</x-nav-link>
                            @php
                                $department_id = auth()->user()->employee->department->id ?? null;
                            @endphp

                            @if ($department_id === 1)
                                <x-nav-link href="/employees" :active="request()->is('employees*')" type="a">Employees</x-nav-link>
                                <x-nav-link href="/departments" :active="request()->is('departments*')" type="a">Departments</x-nav-link>
                                <x-nav-link href="/customers" :active="request()->is('customers*')" type="a">Customers</x-nav-link>
                                <x-nav-link href="/marketing/offers" :active="request()->is('marketing*')" type="a">Offers</x-nav-link>
                                <x-nav-link href="/stores" :active="request()->is('stores*')" type="a">Stores</x-nav-link>
                                <x-nav-link href="/warehouses" :active="request()->is('warehouses*')" type="a">Warehouses</x-nav-link>
                                <x-nav-link href="/products" :active="request()->is('products*')" type="a">Products</x-nav-link>
                            @elseif ($department_id === 2)
                                <x-nav-link href="/employees" :active="request()->is('employees*')" type="a">Employees</x-nav-link>
                                <x-nav-link href="/departments" :active="request()->is('departments*')" type="a">Departments</x-nav-link>
                            @elseif($department_id === 3)
                                <x-nav-link href="/customers" :active="request()->is('customers*')" type="a">Customers</x-nav-link>
                                <x-nav-link href="/marketing/offers" :active="request()->is('marketing*')" type="a">Offers</x-nav-link>
                            @elseif($department_id === 4)
                                <x-nav-link href="/stores" :active="request()->is('stores*')" type="a">Stores</x-nav-link>
                            @elseif($department_id === 5)
                                <x-nav-link href="/warehouses" :active="request()->is('warehouses*')" type="a">Warehouses</x-nav-link>
                            @elseif($department_id === 6)
                                <x-nav-link href="/products" :active="request()->is('products*')" type="a">Products</x-nav-link>
                            @endif
                        @endauth

                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    {{-- @guest
                        <x-nav-link href="/login" :active="request()->is('login')" type='a'>login</x-nav-link>
                    @endguest --}}


                    @auth
                        <div>
                            <form method="POST" action="/logout">
                                @csrf
                                <x-form.button>logout</x-form.button>
                            </form>
                        </div>

                        @if (Auth::user()->employee->department->DeptName === 'Human resources')
                            <div class="relative">
                                <a href="/password-reset-requests" class="relative inline-flex items-center">
                                    <svg class="size-6 text-gray-300 hover:text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    @if (\App\Models\PasswordResetRequest::pending()->count() > 0)
                                        <span
                                            class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                                            {{ \App\Models\PasswordResetRequest::pending()->count() }}
                                        </span>
                                    @endif
                                </a>
                            </div>
                        @endif


                        <div class="relative ml-3">
                            <div>
                                <a href="/profile"
                                    class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Open user menu</span>
                                    <img class="size-8 rounded-full"
                                        src="{{ Auth::user()->employee->person->avatar_url
                                            ? asset('storage/' . Auth::user()->employee->person->avatar_url)
                                            : asset('storage/avatars/profile.png') }}"
                                        alt="">
                                </a>
                            </div>

                        </div>
                    @endauth
                </div>
            </div>

        </div>
    </div>


</nav>
