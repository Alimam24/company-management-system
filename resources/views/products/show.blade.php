<x-layouts.app>
    <x-slot:heading>
        Product Details
    </x-slot>

    <div class="bg-gray-50 min-h-screen p-6 flex justify-center items-start">
        <div class="bg-white rounded-xl shadow-md w-full max-w-3xl p-8 border border-gray-200">
            <!-- Header -->
            <div class="flex items-center gap-6 border-b border-gray-200 pb-6">
                <!-- Product Image -->
                <img src="{{ $product->avatar_url }}" alt="{{ $product->name }}"
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

            <!-- Footer Buttons -->
            <div class="mt-8 flex justify-end gap-4">
                <!-- Edit -->
                <a href="/products/{{ $product->id }}/edit"
                    class="bg-purple-700 text-white hover:bg-purple-800 px-4 py-2 rounded-lg font-medium">
                    Edit Product
                </a>

                <!-- Delete -->
                <form method="POST" action="/products/{{ $product->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-700 text-white hover:bg-red-800 px-4 py-2 rounded-lg font-medium">
                        Delete Product
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
