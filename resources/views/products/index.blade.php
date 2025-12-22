<x-layouts.app>
    <x-slot:heading>
        Products
    </x-slot>

      @include('partials.product_searchbar')

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 text-left">Photo</th>
                    <th class="px-4 py-3 text-left">Product Name</th>
                    <th class="px-4 py-3 text-left">Cost</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <img src={{ asset($product->avatar_url) }} class="w-12 h-12 object-cover rounded" />
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $product->name }}</td>
                        <td class="px-4 py-3 text-gray-700">${{ $product->price }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="/products/{{ $product->id }}"
                                class="text-blue-600 hover:text-blue-800 font-medium">View</a>
                            <a href="/products/{{ $product->id }}/edit"
                                class="text-yellow-600 hover:text-yellow-800 font-medium">Edit</a>
                            @can('manage')
                            <form action="/products/{{ $product->id }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                    Delete
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="mt-10">
            {{ $products->links() }}
        </div>

</x-layouts.app>
