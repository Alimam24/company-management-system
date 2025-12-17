<x-layouts.app>
    <x-slot:heading>
        Product Details
    </x-slot>

    <div class="bg-gray-50 min-h-screen p-6 flex justify-center items-start">
        <div class="bg-white rounded-xl shadow-md w-full max-w-3xl p-8 border border-gray-200">
            <!-- Header -->
            <div class="flex items-center gap-6 border-b border-gray-200 pb-6">
                <!-- Product Image -->
                <img  src="{{ $product->avatar_url 
                 ? asset('storage/' . $product->avatar_url) 
                 : asset('img/profile.png') }}"alt="{{ $product->name }}"
                    class="w-32 h-32 rounded-lg object-cover border">

                <!-- Product Basic Info -->
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                    <p class="text-gray-500 mt-1">Added on {{ $product->created_at->format('F j, Y') }}</p>
                    <p class="text-2xl text-purple-700 font-semibold mt-2">${{ number_format($product->price, 2) }}</p>
                </div>
            </div>

            <!-- Description Section -->
            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Description</h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $product->description ?? 'No description available for this product.' }}
                </p>
            </div>

            <!-- Available in Retail Stores Section -->
            <div class="mt-8 border-t border-gray-200 pt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Available in Retail Stores</h2>
                @if($product->retail_stores && $product->retail_stores->count() > 0)
                    <div class="space-y-3">
                        @foreach($product->retail_stores as $store)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors">
                                <div class="flex-1">
                                    <a href="{{ route('stores.show', $store) }}" 
                                       class="text-purple-700 hover:text-purple-800 font-medium text-lg">
                                        {{ $store->StoreName }}
                                    </a>
                                    <p class="text-sm text-gray-600 mt-1">{{ $store->City->Name ?? 'N/A' }}, {{ $store->Address }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                                        Quantity: {{ $store->pivot->amount }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-6 bg-gray-50 rounded-lg border border-gray-200 text-center">
                        <p class="text-gray-600">This product is not currently available in any retail stores.</p>
                    </div>
                @endif
            </div>

            <!-- Available in Warehouses Section -->
            <div class="mt-8 border-t border-gray-200 pt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Available in Warehouses</h2>
                @if($product->warehouses && $product->warehouses->count() > 0)
                    <div class="space-y-3">
                        @foreach($product->warehouses as $warehouse)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors">
                                <div class="flex-1">
                                    <a href="{{ route('warehouses.show', $warehouse) }}" 
                                       class="text-purple-700 hover:text-purple-800 font-medium text-lg">
                                        {{ $warehouse->WarehouseName }}
                                    </a>
                                    <p class="text-sm text-gray-600 mt-1">{{ $warehouse->City->Name ?? 'N/A' }}, {{ $warehouse->Address }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                        Quantity: {{ $warehouse->pivot->amount }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-6 bg-gray-50 rounded-lg border border-gray-200 text-center">
                        <p class="text-gray-600">This product is not currently available in any warehouses.</p>
                    </div>
                @endif
            </div>

            <!-- Footer Buttons -->
            <div class="mt-8 flex justify-end gap-4">
                <!-- Edit -->
                <a href="/products/{{ $product->id }}/edit"
                    class="bg-purple-700 text-white hover:bg-purple-800 px-4 py-2 rounded-lg font-medium">
                    Edit Product
                </a>
                @can('manage')
                <!-- Delete -->
                <form method="POST" action="/products/{{ $product->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-700 text-white hover:bg-red-800 px-4 py-2 rounded-lg font-medium">
                        Delete Product
                    </button>
                </form>
                @endcan
            </div>
        </div>
    </div>
</x-layouts.app>
