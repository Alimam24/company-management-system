<x-layouts.app>
    <x-slot:heading>
        Dashboard
    </x-slot>

    <div class="space-y-8">
        {{-- Welcome Section --}}
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl shadow-lg p-8 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-2">
                        Welcome back, {{ optional(optional(Auth::user()->employee)->person)->FirstName ?? 'User' }}! 
                    </h2>
                    <p class="text-indigo-100 text-lg">
                        Here's what's happening with your business today.
                    </p>
                </div>
                <div class="hidden md:block">
                    <svg class="w-32 h-32 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            {{-- Employees Card --}}
            <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Employees</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['employees'] }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                @php
                    $department_id = auth()->user()->employee->department->id ?? null;
                @endphp
                @if ($department_id === 1 || $department_id === 2)
                    <a href="/employees" class="mt-4 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                        View all <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                @endif
            </div>

            {{-- Customers Card --}}
            <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Customers</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['customers'] }}</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
                @if ($department_id === 1 || $department_id === 3)
                    <a href="/customers" class="mt-4 inline-flex items-center text-sm font-medium text-green-600 hover:text-green-800">
                        View all <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                @endif
            </div>

            {{-- Products Card --}}
            <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Products</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['products'] }}</p>
                    </div>
                    <div class="bg-purple-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
                @if ($department_id === 1 || $department_id === 6)
                    <a href="/products" class="mt-4 inline-flex items-center text-sm font-medium text-purple-600 hover:text-purple-800">
                        View all <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                @endif
            </div>

            {{-- Stores Card --}}
            <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Retail Stores</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['stores'] }}</p>
                    </div>
                    <div class="bg-orange-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
                @if ($department_id === 1 || $department_id === 4)
                    <a href="/stores" class="mt-4 inline-flex items-center text-sm font-medium text-orange-600 hover:text-orange-800">
                        View all <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                @endif
            </div>
        </div>

        {{-- Warehouses Card (Full Width) --}}
        @if ($department_id === 1 || $department_id === 5)
        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border-l-4 border-teal-500">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-teal-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Warehouses</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['warehouses'] }}</p>
                    </div>
                </div>
                <a href="/warehouses" class="inline-flex items-center px-4 py-2 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 transition-colors">
                    View Warehouses <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
        @endif

        {{-- Quick Actions Section --}}
        <div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @if ($department_id === 1 || $department_id === 2)
                    <a href="/employees/create" class="group bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 p-6 border border-gray-200 hover:border-blue-500">
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-100 group-hover:bg-blue-200 rounded-lg p-3 transition-colors">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 group-hover:text-blue-600">Add Employee</h4>
                                <p class="text-sm text-gray-500">Create a new employee record</p>
                            </div>
                        </div>
                    </a>
                @endif

                @if ($department_id === 1 || $department_id === 3)
                    <a href="/customers/create" class="group bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 p-6 border border-gray-200 hover:border-green-500">
                        <div class="flex items-center space-x-4">
                            <div class="bg-green-100 group-hover:bg-green-200 rounded-lg p-3 transition-colors">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 group-hover:text-green-600">Add Customer</h4>
                                <p class="text-sm text-gray-500">Register a new customer</p>
                            </div>
                        </div>
                    </a>
                @endif

                @if ($department_id === 1 || $department_id === 4)
                    <a href="/stores/create" class="group bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 p-6 border border-gray-200 hover:border-orange-500">
                        <div class="flex items-center space-x-4">
                            <div class="bg-orange-100 group-hover:bg-orange-200 rounded-lg p-3 transition-colors">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 group-hover:text-orange-600">Add Store</h4>
                                <p class="text-sm text-gray-500">Create a new retail store</p>
                            </div>
                        </div>
                    </a>
                @endif

                @if ($department_id === 1 || $department_id === 5)
                    <a href="/warehouses/create" class="group bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 p-6 border border-gray-200 hover:border-teal-500">
                        <div class="flex items-center space-x-4">
                            <div class="bg-teal-100 group-hover:bg-teal-200 rounded-lg p-3 transition-colors">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 group-hover:text-teal-600">Add Warehouse</h4>
                                <p class="text-sm text-gray-500">Create a new warehouse</p>
                            </div>
                        </div>
                    </a>
                @endif

                @if ($department_id === 1 || $department_id === 6)
                    <a href="/products/create" class="group bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 p-6 border border-gray-200 hover:border-purple-500">
                        <div class="flex items-center space-x-4">
                            <div class="bg-purple-100 group-hover:bg-purple-200 rounded-lg p-3 transition-colors">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 group-hover:text-purple-600">Add Product</h4>
                                <p class="text-sm text-gray-500">Add a new product to inventory</p>
                            </div>
                        </div>
                    </a>
                @endif

                @if ($department_id === 1)
                    <a href="/departments" class="group bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 p-6 border border-gray-200 hover:border-indigo-500">
                        <div class="flex items-center space-x-4">
                            <div class="bg-indigo-100 group-hover:bg-indigo-200 rounded-lg p-3 transition-colors">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600">Departments</h4>
                                <p class="text-sm text-gray-500">Manage departments</p>
                            </div>
                        </div>
                    </a>
                @endif

                @if ($department_id === 1 || $department_id === 3)
                    <a href="/marketing/offers" class="group bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 p-6 border border-gray-200 hover:border-pink-500">
                        <div class="flex items-center space-x-4">
                            <div class="bg-pink-100 group-hover:bg-pink-200 rounded-lg p-3 transition-colors">
                                <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 group-hover:text-pink-600">Marketing Offers</h4>
                                <p class="text-sm text-gray-500">View and manage offers</p>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
        </div>

        {{-- Recent Activity or Info Section --}}
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
            <div class="flex items-start space-x-4">
                <div class="bg-indigo-100 rounded-full p-2">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-900 mb-1">Getting Started</h4>
                    <p class="text-sm text-gray-600">
                        Use the quick actions above to add new records, or navigate through the menu to explore different sections of the system. 
                        Your dashboard provides an overview of key metrics and quick access to frequently used features.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
