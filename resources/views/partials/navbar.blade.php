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
                        <x-nav-link href="/" :active="request()->is('/')" type='a'>Home</x-nav-link>

                        @auth
                            @php
                                $department_id = auth()->user()->employee->department->id ?? null;
                            @endphp

                            @if ($department_id === 2)
                                <x-nav-link href="/employees" :active="request()->is('employees*')" type="a">Employees</x-nav-link>
                            @elseif($department_id === 3)
                                <x-nav-link href="/customers" :active="request()->is('customers*')" type="a">Customers</x-nav-link>
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
                    @guest
                        <x-nav-link href="/login" :active="request()->is('login')" type='a'>login</x-nav-link>
                        {{-- <x-nav-link href="/register" :active="request()->is('register')" type='a'>register</x-nav-link> --}}
                    @endguest


                    @auth
                        <div>
                            <form method="POST" action="/logout">
                                @csrf
                                <x-form.button>logout</x-form.button>
                            </form>
                        </div>
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
