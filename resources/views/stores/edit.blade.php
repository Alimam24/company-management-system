<x-layouts.app>
    <x-slot:heading>
        Edit Retail Store: {{ $store->StoreName }}
    </x-slot>

    <form method="POST" action="/stores/{{ $store->id }}">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Enter store details:</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">

                    <!-- Store Name -->
                    <div>
                        <x-form.label for="store_name">Store Name</x-form.label>
                        <x-form.input 
                            type="text" 
                            name="store_name" 
                            id="store_name" 
                            value="{{ old('store_name', $store->StoreName) }}" 
                            placeholder="Enter store name"
                        />
                        <x-form.error name="store_name" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-form.label for="phone">Store Phone Number</x-form.label>
                        <x-form.input 
                            type="text" 
                            name="phone" 
                            id="phone" 
                            value="{{ old('phone', $store->Phone) }}" 
                            placeholder="Enter store phone number"
                        />
                        <x-form.error name="phone" />
                    </div>

                    <!-- City -->
                    <div>
                        <x-form.label for="city_id">City</x-form.label>
                        <x-form.select name="city_id" id="city_id">
                            @foreach ($Cities as $city)
                                <option value="{{ $city->id }}" 
                                    {{ old('city_id', $store->city_id) == $city->id ? 'selected' : '' }}>
                                    {{ $city->Name }}
                                </option>
                            @endforeach
                        </x-form.select>
                        <x-form.error name="city_id" />
                    </div>

                    <!-- Address -->
                    <div>
                        <x-form.label for="address">Store Address</x-form.label>
                        <x-form.input 
                            type="text" 
                            name="address" 
                            id="address" 
                            value="{{ old('address', $store->Address) }}" 
                            placeholder="Enter store address"
                        />
                        <x-form.error name="address" />
                    </div>

                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/stores" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form.button type="submit">Save</x-form.button>
        </div>
    </form>
</x-layouts.app>
