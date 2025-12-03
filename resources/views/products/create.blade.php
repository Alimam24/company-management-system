<x-layouts.app>
    <x-slot:heading>
        Add New Product
    </x-slot>

    <form method="POST" action="/products">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Enter product details:</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">

                    <!-- Product Name -->
                    <div>
                        <x-form.label for="name">Product Name</x-form.label>
                        <x-form.input type="text" name="name" id="name" value="{{ old('name') }}"
                            placeholder="Enter product name" />
                        <x-form.error name="name" />
                    </div>

                    <!-- Product Price -->
                    <div>
                        <x-form.label for="price">Product Price</x-form.label>
                        <x-form.input type="text" name="price" id="price" value="{{ old('price') }}"
                            placeholder="Enter product price" />
                        <x-form.error name="price" />
                    </div>

                    <!-- Product Description -->
                    <div class="sm:col-span-2">
                        <x-form.label for="description">Product Description</x-form.label>
                        <x-form.textarea name="description" id="description" rows="6"
                            placeholder="Describe the product..." />

                        <x-form.error name="description" />
                    </div>

                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/products" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form.button type="submit">Save</x-form.button>
        </div>
    </form>
</x-layouts.app>
