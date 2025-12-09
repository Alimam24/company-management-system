<x-layouts.app>
    <x-slot:heading>
        Assign Products to {{ $warehouse->WarehouseName }}
    </x-slot>

    <div class="bg-slate-50">
        <div class="min-h-screen py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div class="mb-6 sm:mb-0">
                        <h1 class="text-4xl font-bold text-slate-900">Assign Products</h1>
                        <p class="text-slate-600 mt-2 text-lg">Select products and specify quantities for {{ $warehouse->WarehouseName }}</p>
                    </div>
                </div>

                <!-- Back to Products Link -->
                <div class="mb-4">
                    <a href="{{ route('warehouses.products', $warehouse) }}" 
                       class="text-purple-700 hover:text-purple-800 font-medium flex items-center gap-2">
                        ← Back to Products
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

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Search Bar -->
                <form method="GET" class="mb-6">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products by name..."
                        class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 text-slate-700" />
                    <button type="submit" class="mt-2 px-4 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800">
                        Search
                    </button>
                </form>

                <form method="POST" action="{{ route('warehouses.products.assign.submit', $warehouse) }}" id="assignForm">
                    @csrf

                    <!-- Table Container -->
                    <div class="bg-white shadow-lg rounded-xl border border-slate-200 overflow-hidden">
                        @if($products->count() > 0)
                            <table class="w-full border-collapse">
                                <thead
                                    class="bg-linear-to-r from-slate-50 to-slate-100 border-b border-slate-200 hidden sm:table-header-group">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                                            Select
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Product</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Price</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Quantity</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $product)
                                        <!-- Desktop Row -->
                                        <tr
                                            class="border-b border-slate-200 hover:bg-slate-50 transition-colors hidden sm:table-row">
                                            <td class="px-6 py-4">
                                                <input type="checkbox" name="product_checkbox[]" value="{{ $product->id }}"
                                                    class="product-checkbox w-4 h-4 text-purple-600 border-slate-300 rounded"
                                                    onchange="toggleQuantityInput({{ $product->id }})">
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <img src="{{ $product->avatar_url }}"
                                                        alt="{{ $product->name }}" class="w-10 h-10 rounded-lg object-cover">
                                                    <div>
                                                        <p class="font-medium text-slate-900">{{ $product->name }}</p>
                                                        <p class="text-xs text-slate-500">ID: {{ $product->id }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-slate-700">${{ number_format($product->price, 2) }}</td>
                                            <td class="px-6 py-4">
                                                <input type="number" 
                                                       name="products[{{ $product->id }}][quantity]" 
                                                       id="quantity_{{ $product->id }}"
                                                       min="0" 
                                                       value="0"
                                                       disabled
                                                       required
                                                       class="quantity-input w-24 px-3 py-1 text-sm border border-slate-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-600 disabled:bg-slate-100 disabled:cursor-not-allowed">
                                                <input type="hidden" name="products[{{ $product->id }}][id]" value="{{ $product->id }}">
                                            </td>
                                        </tr>

                                        <!-- Mobile Card -->
                                        <tr class="sm:hidden">
                                            <td class="p-0">
                                                <div class="p-4 border-b border-slate-200 hover:bg-slate-50 transition-colors">
                                                    <div class="flex items-center gap-3 mb-3">
                                                        <input type="checkbox" name="product_checkbox[]" value="{{ $product->id }}"
                                                            class="product-checkbox w-5 h-5 text-purple-600 border-slate-300 rounded"
                                                            onchange="toggleQuantityInput({{ $product->id }})">
                                                        <img src="{{ $product->avatar_url }}"
                                                            alt="{{ $product->name }}"
                                                            class="w-12 h-12 rounded-lg object-cover">
                                                        <div class="flex-1">
                                                            <p class="font-semibold text-slate-900">{{ $product->name }}</p>
                                                            <p class="text-xs text-slate-500">ID: {{ $product->id }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="space-y-2 mb-4">
                                                        <div class="flex justify-between">
                                                            <span class="text-slate-600 text-sm">Price:</span>
                                                            <span class="text-slate-900 text-sm font-medium">${{ number_format($product->price, 2) }}</span>
                                                        </div>
                                                        <div class="flex justify-between items-center">
                                                            <span class="text-slate-600 text-sm">Quantity:</span>
                                                            <input type="number" 
                                                                   name="products[{{ $product->id }}][quantity]" 
                                                                   id="quantity_mobile_{{ $product->id }}"
                                                                   min="0" 
                                                                   value="0"
                                                                   disabled
                                                                   required
                                                                   class="quantity-input w-24 px-3 py-1 text-sm border border-slate-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-600 disabled:bg-slate-100 disabled:cursor-not-allowed">
                                                            <input type="hidden" name="products[{{ $product->id }}][id]" value="{{ $product->id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-12 text-center">
                                <p class="text-slate-600 text-lg mb-4">
                                    @if(request('search'))
                                        No products found matching "{{ request('search') }}".
                                    @else
                                        No products available to assign. All products are already assigned to this warehouse.
                                    @endif
                                </p>
                                <a href="{{ route('warehouses.products', $warehouse) }}"
                                    class="inline-block px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition">
                                    Back to Products
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Submit button -->
                    @if($products->count() > 0)
                        <button type="submit"
                            class="mt-6 w-full sm:w-auto px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition transform hover:scale-105 active:scale-95">
                            Assign Selected Products
                        </button>
                    @endif
                </form>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function toggleQuantityInput(productId) {
            const checkbox = document.querySelector(`input[value="${productId}"].product-checkbox`);
            const quantityInput = document.getElementById(`quantity_${productId}`);
            const quantityInputMobile = document.getElementById(`quantity_mobile_${productId}`);
            
            if (checkbox && checkbox.checked) {
                if (quantityInput) {
                    quantityInput.disabled = false;
                    quantityInput.focus();
                }
                if (quantityInputMobile) {
                    quantityInputMobile.disabled = false;
                    quantityInputMobile.focus();
                }
            } else {
                if (quantityInput) {
                    quantityInput.disabled = true;
                    quantityInput.value = 0;
                }
                if (quantityInputMobile) {
                    quantityInputMobile.disabled = true;
                    quantityInputMobile.value = 0;
                }
            }
        }

        // Form submission validation
        document.getElementById('assignForm').addEventListener('submit', function(e) {
            const checkedBoxes = document.querySelectorAll('.product-checkbox:checked');
            if (checkedBoxes.length === 0) {
                e.preventDefault();
                alert('Please select at least one product to assign.');
                return false;
            }

            // Validate that all checked products have quantity > 0
            let hasInvalidQuantity = false;
            checkedBoxes.forEach(checkbox => {
                const productId = checkbox.value;
                const quantityInput = document.getElementById(`quantity_${productId}`) || document.getElementById(`quantity_mobile_${productId}`);
                if (quantityInput && parseInt(quantityInput.value) < 0) {
                    hasInvalidQuantity = true;
                }
            });

            if (hasInvalidQuantity) {
                e.preventDefault();
                alert('All selected products must have a quantity of 0 or greater.');
                return false;
            }
        });
    </script>

</x-layouts.app>
