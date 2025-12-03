<x-layouts.app>
    <x-slot:heading>
        Warehouses
    </x-slot>

    @include('partials.warehouse_searchbar')




<div class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($warehouses as $warehouse)
            <a href="/warehouses/{{ $warehouse->id }}">
                <!-- warehouse Card -->
                <article
                    class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6 border border-gray-200 flex flex-col h-64 overflow-hidden">

                    <!-- warehouse Name -->
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 truncate">{{ $warehouse->WarehouseName }}</h2>

                    <!-- warehouse Details -->
                    <div class="space-y-3 flex-1 overflow-hidden">
                        <!-- City -->
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-500 mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div class="flex-1 truncate">
                                <p class="text-sm font-medium text-gray-500">City</p>
                                <p class="text-base text-gray-900 truncate">{{ $warehouse->City->Name }}</p>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-500 mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <div class="flex-1 truncate">
                                <p class="text-sm font-medium text-gray-500">Address</p>
                                <p class="text-base text-gray-900 truncate">{{ $warehouse->Address }}</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-500 mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            <div class="flex-1 truncate">
                                <p class="text-sm font-medium text-gray-500">Phone</p>
                                <p class="text-base text-gray-900 truncate">{{ $warehouse->Phone }}</p>
                            </div>
                        </div>
                    </div>
                </article>
            </a>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $warehouses->links() }}
    </div>
</div>


</x-layouts.app>
