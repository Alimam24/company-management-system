<x-layouts.app>
    <x-slot:heading>
       Retail Store
    </x-slot>

    <div class="bg-gray-50 min-h-screen py-10 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Store Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="px-8 py-6">

                <!-- Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $store->StoreName }}</h1>
                        <p class="text-gray-500 mt-1">{{ $store->City->Name }}, {{ $store->Address }}</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            Joined: {{ $store->created_at ? $store->created_at->format('d/m/Y') : 'N/A' }}
                        </span>
                    </div>
                </div>

                <!-- Store Details -->
                <div class="space-y-4 p-6 bg-gray-50 rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">Store Details</h2>

                    <div class="flex justify-between text-gray-700">
                        <span>City:</span>
                        <span class="font-medium text-gray-900">{{ $store->City->Name }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Address:</span>
                        <span class="font-medium text-gray-900">{{ $store->Address }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Phone:</span>
                        <span class="font-medium text-gray-900">{{ $store->Phone }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Join Date:</span>
                        <span class="font-medium text-gray-900">{{ $store->created_at ? $store->created_at->format('d/m/Y') : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Manager:</span>
                        <span class="font-medium text-gray-900">
                            @if($store->manager)
                                {{ $store->manager->person->FirstName . ' ' . $store->manager->person->LastName }}
                            @else
                                <span class="text-gray-400">Not assigned</span>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Employees:</span>
                        <span class="font-medium text-gray-900">{{$store->employees()->count()}}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Products:</span>
                        <span class="font-medium text-gray-900">{{$store->products->count()}}</span>
                    </div>
                </div>

                <!-- Products Section -->
                @if($store->products && $store->products->count() > 0)
                <div class="mt-6 p-6 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Products in This Store</h2>
                        <a href="{{ route('stores.products', $store) }}" 
                           class="text-purple-700 hover:text-purple-800 font-medium text-sm">
                            View All →
                        </a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($store->products->take(6) as $product)
                            <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                                <div class="flex items-center gap-3 flex-1 min-w-0">
                                    <img src="{{ $product->avatar_url }}" alt="{{ $product->name }}" 
                                         class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('products.show', $product) }}" 
                                           class="text-gray-900 font-medium hover:text-purple-700 truncate block">
                                            {{ $product->name }}
                                        </a>
                                        <p class="text-xs text-gray-500">Qty: {{ $product->pivot->amount }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($store->products->count() > 6)
                        <div class="mt-4 text-center">
                            <a href="{{ route('stores.products', $store) }}" 
                               class="text-purple-700 hover:text-purple-800 font-medium">
                                View {{ $store->products->count() - 6 }} more products →
                            </a>
                        </div>
                    @endif
                </div>
                @else
                <div class="mt-6 p-6 bg-gray-50 rounded-lg text-center">
                    <p class="text-gray-600 mb-4">No products assigned to this store yet.</p>
                    <a href="{{ route('stores.products.assign.page', $store) }}" 
                       class="inline-block px-4 py-2 bg-teal-600 text-white text-sm font-medium rounded-lg shadow hover:bg-teal-700 transition-all duration-150">
                        Assign Products
                    </a>
                </div>
                @endif

                <!-- Actions -->
                <div class="flex flex-wrap items-center justify-end gap-3 pt-5 border-t border-gray-100">
                    <a href="{{ route('stores.manager.assign.page', $store) }}" 
                       class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition-all duration-150">
                        {{ $store->manager ? 'Change Manager' : 'Assign Manager' }}
                    </a>

                    @if($store->manager)
                    <form method="POST" action="{{ route('stores.manager.remove', $store) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Remove manager from this store?')"
                            class="px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-lg shadow hover:bg-orange-700 transition-all duration-150">
                            Remove Manager
                        </button>
                    </form>
                    @endif

                    <a href="{{ route('stores.employees', $store) }}" 
                       class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition-all duration-150">
                        Manage Employees
                    </a>

                    <a href="{{ route('stores.products', $store) }}" 
                       class="px-4 py-2 bg-teal-600 text-white text-sm font-medium rounded-lg shadow hover:bg-teal-700 transition-all duration-150">
                        Manage Products
                    </a>

                    <a href="/stores/{{ $store->id }}/edit" 
                       class="px-4 py-2 bg-purple-700 text-white text-sm font-medium rounded-lg shadow hover:bg-purple-800 transition-all duration-150">
                        Edit Store
                    </a>

                    <form method="POST" action="/stores/{{ $store->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg shadow hover:bg-red-700 transition-all duration-150">
                            Remove Store
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>




</x-layouts.app>
