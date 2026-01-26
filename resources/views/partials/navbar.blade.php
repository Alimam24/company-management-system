<nav class="bg-gray-800">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <!-- Logo -->
      <div class="flex items-center">
        <div class="shrink-0">
          <img class="h-8 w-8"
            src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
            alt="Your Company">
        </div>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden md:flex md:items-center md:space-x-4">
        @auth
          <x-nav-link href="/" :active="request()->is('/')" type='a'>Home</x-nav-link>
          @php $department_id = auth()->user()->employee->department->id ?? null; @endphp

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

      <!-- Right Section (Profile / Logout / Icons) -->
      <div class="hidden md:flex md:items-center md:space-x-4">
        @auth
          <form method="POST" action="/logout">
            @csrf
            <x-form.button>Logout</x-form.button>
          </form>

          @if (Auth::user()->employee->department->DeptName === 'Human resources')
            <div class="relative">
              <a href="/password-reset-requests" class="relative inline-flex items-center">
                <svg class="h-6 w-6 text-gray-300 hover:text-white" fill="none" stroke="currentColor"
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

          <a href="/profile">
            <img class="h-8 w-8 rounded-full"
              src="{{ Auth::user()->employee->person->avatar_url ? asset('storage/' . Auth::user()->employee->person->avatar_url) : asset('storage/avatars/profile.png') }}"
              alt="">
          </a>
        @endauth
      </div>

      <!-- Mobile menu button -->
      <div class="md:hidden flex items-center">
        <button id="mobile-menu-button" class="text-gray-300 hover:text-white focus:outline-none">
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>

 <!-- Mobile Menu -->
<div id="mobile-menu" class="hidden md:hidden bg-gray-800 px-2 pt-2 pb-3 space-y-1">
  @auth
    <!-- Navigation links -->
    <x-nav-link href="/" :active="request()->is('/')" type='a'>Home</x-nav-link>
    @php $department_id = auth()->user()->employee->department->id ?? null; @endphp

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

    <!-- HR Notification Bell -->
    @if (Auth::user()->employee->department->DeptName === 'Human resources')
      <a href="/password-reset-requests" class="flex items-center px-2 py-2 text-gray-300 hover:text-white hover:bg-gray-700 rounded-md">
        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        Password Reset Requests
        @if (\App\Models\PasswordResetRequest::pending()->count() > 0)
          <span
            class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
            {{ \App\Models\PasswordResetRequest::pending()->count() }}
          </span>
        @endif
      </a>
    @endif

    <!-- Profile Avatar -->
    <a href="/profile" class="flex items-center px-2 py-2 text-gray-300 hover:text-white hover:bg-gray-700 rounded-md">
      <img class="h-8 w-8 rounded-full mr-2"
        src="{{ Auth::user()->employee->person->avatar_url ? asset('storage/' . Auth::user()->employee->person->avatar_url) : asset('storage/avatars/profile.png') }}"
        alt="Profile">
      Profile
    </a>

    <!-- Logout Button -->
    <form method="POST" action="/logout">
      @csrf
      <x-form.button class="w-full mt-2">Logout</x-form.button>
    </form>
  @endauth
</div>

</nav>

<script>
  // Mobile menu toggle
  const menuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  menuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>
