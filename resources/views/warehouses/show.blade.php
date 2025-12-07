<x-layouts.app>
    <x-slot:heading>
        Warehouse
    </x-slot>

    <div class="bg-gray-50 min-h-screen py-10 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- warehouse Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="px-8 py-6">

                <!-- Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $warehouse->WarehouseName }}</h1>
                        <p class="text-gray-500 mt-1">{{ $warehouse->City->Name }}, {{ $warehouse->Address }}</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            Joined: {{ $warehouse->created_at ? $warehouse->created_at->format('d/m/Y') : 'N/A' }}
                        </span>
                    </div>
                </div>

                <!-- warehouse Details -->
                <div class="space-y-4 p-6 bg-gray-50 rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">warehouse Details</h2>

                    <div class="flex justify-between text-gray-700">
                        <span>City:</span>
                        <span class="font-medium text-gray-900">{{ $warehouse->City->Name }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Address:</span>
                        <span class="font-medium text-gray-900">{{ $warehouse->Address }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Phone:</span>
                        <span class="font-medium text-gray-900">{{ $warehouse->Phone }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Join Date:</span>
                        <span class="font-medium text-gray-900">{{ $warehouse->created_at ? $warehouse->created_at->format('d/m/Y') : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Manager:</span>
                        <span class="font-medium text-gray-900">
                            @if($warehouse->manager)
                                {{ $warehouse->manager->person->FirstName . ' ' . $warehouse->manager->person->LastName }}
                            @else
                                <span class="text-gray-400">Not assigned</span>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Employees:</span>
                        <span class="font-medium text-gray-900">{{ $warehouse->employees()->count() }}</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-wrap items-center justify-end gap-3 pt-5 border-t border-gray-100">
                    <a href="{{ route('warehouses.manager.assign.page', $warehouse) }}" 
                       class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition-all duration-150">
                        {{ $warehouse->manager ? 'Change Manager' : 'Assign Manager' }}
                    </a>

                    @if($warehouse->manager)
                    <form method="POST" action="{{ route('warehouses.manager.remove', $warehouse) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Remove manager from this warehouse?')"
                            class="px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-lg shadow hover:bg-orange-700 transition-all duration-150">
                            Remove Manager
                        </button>
                    </form>
                    @endif

                    <a href="{{ route('warehouses.employees', $warehouse) }}" 
                       class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition-all duration-150">
                        Manage Employees
                    </a>

                    <a href="/warehouses/{{ $warehouse->id }}/edit" 
                       class="px-4 py-2 bg-purple-700 text-white text-sm font-medium rounded-lg shadow hover:bg-purple-800 transition-all duration-150">
                        Edit warehouse
                    </a>

                    <form method="POST" action="/warehouses/{{ $warehouse->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg shadow hover:bg-red-700 transition-all duration-150">
                            Remove warehouse
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>




</x-layouts.app>
