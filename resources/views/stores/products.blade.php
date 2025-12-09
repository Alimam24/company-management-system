<x-layouts.app>
    <x-slot:heading>
        Retail Store - Products
    </x-slot>

    <div class="bg-slate-50">
        <div class="min-h-screen py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div class="mb-6 sm:mb-0">
                        <h1 class="text-4xl font-bold text-slate-900">Products in Store</h1>
                        <p class="text-slate-600 mt-2 text-lg">{{ $store->StoreName }} - Manage products and inventory</p>
                    </div>

                    <a href="{{ route('stores.products.assign.page', $store) }}"
                        class="w-full sm:w-auto px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition transform hover:scale-105 active:scale-95">
                        + Assign Product
                    </a>
                </div>

                <!-- Back to Store Link -->
                <div class="mb-4">
                    <a href="{{ route('stores.show', $store) }}" 
                       class="text-purple-700 hover:text-purple-800 font-medium flex items-center gap-2">
                        ← Back to Store Details
                    </a>
                </div>

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Search Bar -->
                <form method="GET" class="mb-6">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products by name..."
                        class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 text-slate-700" />
                </form>

                <!-- Table Container -->
                <div class="bg-white shadow-lg rounded-xl border border-slate-200 overflow-hidden">
                    @if($products->count() > 0)
                        <table class="w-full border-collapse">
                            <thead
                                class="bg-linear-to-r from-slate-50 to-slate-100 border-b border-slate-200 hidden sm:table-header-group">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Product</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Price</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Quantity</th>
                                    <th class="px-6 py-4 text-right text-sm font-semibold text-slate-700">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                    <!-- Desktop Row -->
                                    <tr
                                        class="border-b border-slate-200 hover:bg-slate-50 transition-colors hidden sm:table-row">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ $product->avatar_url }}"
                                                    alt="{{ $product->name }}" class="w-10 h-10 rounded-lg object-cover">
                                                <div>
                                                    <a href="{{ route('products.show', $product) }}" 
                                                       class="font-medium text-slate-900 hover:text-purple-700">
                                                        {{ $product->name }}
                                                    </a>
                                                    <p class="text-xs text-slate-500">ID: {{ $product->id }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-700">${{ number_format($product->price, 2) }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                                                {{ $product->pivot->amount }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                <!-- Update Quantity Form -->
                                                <form method="POST" action="{{ route('stores.products.update', ['store' => $store, 'product' => $product]) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="number" name="quantity" value="{{ $product->pivot->amount }}" min="0" 
                                                           class="w-20 px-2 py-1 text-sm border border-slate-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-600">
                                                    <button type="submit"
                                                        class="ml-2 px-3 py-1 text-sm font-medium text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                                        Update
                                                    </button>
                                                </form>
                                                <!-- Remove Form -->
                                                <form method="POST" action="{{ route('stores.products.remove', ['store' => $store, 'product' => $product]) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Remove this product from the store?')"
                                                        class="px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition">
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Mobile Card -->
                                    <tr class="sm:hidden">
                                        <td class="p-0">
                                            <div class="p-4 border-b border-slate-200 hover:bg-slate-50 transition-colors">
                                                <div class="flex items-center gap-3 mb-3">
                                                    <img src="{{ $product->avatar_url }}"
                                                        alt="{{ $product->name }}"
                                                        class="w-12 h-12 rounded-lg object-cover">
                                                    <div class="flex-1">
                                                        <a href="{{ route('products.show', $product) }}" 
                                                           class="font-semibold text-slate-900 hover:text-purple-700">
                                                            {{ $product->name }}
                                                        </a>
                                                        <p class="text-xs text-slate-500">ID: {{ $product->id }}</p>
                                                    </div>
                                                </div>

                                                <div class="space-y-2 mb-4">
                                                    <div class="flex justify-between">
                                                        <span class="text-slate-600 text-sm">Price:</span>
                                                        <span class="text-slate-900 text-sm font-medium">${{ number_format($product->price, 2) }}</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-slate-600 text-sm">Quantity:</span>
                                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs font-medium">
                                                            {{ $product->pivot->amount }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Update Quantity Form -->
                                                <form method="POST" action="{{ route('stores.products.update', ['store' => $store, 'product' => $product]) }}" class="mb-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="flex gap-2">
                                                        <input type="number" name="quantity" value="{{ $product->pivot->amount }}" min="0" 
                                                               class="flex-1 px-2 py-1 text-sm border border-slate-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-600">
                                                        <button type="submit"
                                                            class="px-3 py-1 text-sm font-medium text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                                            Update
                                                        </button>
                                                    </div>
                                                </form>

                                                <!-- Remove Form -->
                                                <form method="POST" action="{{ route('stores.products.remove', ['store' => $store, 'product' => $product]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Remove this product from the store?')"
                                                        class="w-full px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition">
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Footer Stats -->
                        <div
                            class="bg-linear-to-r from-slate-50 to-slate-100 border-t border-slate-200 px-6 py-4 flex justify-between text-sm text-slate-600">
                            <span>Total Products: <strong class="text-slate-900">{{ $products->total() }}</strong></span>
                            <span>Last Updated: <strong class="text-slate-900">{{ now()->format('M d, Y') }}</strong></span>
                        </div>
                    @else
                        <div class="p-12 text-center">
                            <p class="text-slate-600 text-lg mb-4">No products found in this store.</p>
                            <a href="{{ route('stores.products.assign.page', $store) }}"
                                class="inline-block px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition">
                                Assign Products
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-layouts.app>
