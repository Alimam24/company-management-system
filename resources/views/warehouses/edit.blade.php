<x-layouts.app>
    <x-slot:heading>
        Edit Retail warehouse: {{ $warehouse->WarehouseName }}
    </x-slot>

    <form method="POST" action="/warehouses/{{ $warehouse->id }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Enter warehouse details:</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">

                    <!-- warehouse Name -->
                    <div>
                        <x-form.label for="WarehouseName">warehouse Name</x-form.label>
                        <x-form.input 
                            type="text" 
                            name="WarehouseName" 
                            id="WarehouseName" 
                            value="{{ old('WarehouseName', $warehouse->WarehouseName) }}" 
                            placeholder="Enter warehouse name"
                        />
                        <x-form.error name="WarehouseName" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-form.label for="phone">warehouse Phone Number</x-form.label>
                        <x-form.input 
                            type="text" 
                            name="phone" 
                            id="phone" 
                            value="{{ old('phone', $warehouse->Phone) }}" 
                            placeholder="Enter warehouse phone number"
                        />
                        <x-form.error name="phone" />
                    </div>

                    <!-- City -->
                    <div>
                        <x-form.label for="city_id">City</x-form.label>
                        <x-form.select name="city_id" id="city_id">
                            @foreach ($Cities as $city)
                                <option value="{{ $city->id }}" 
                                    {{ old('city_id', $warehouse->city_id) == $city->id ? 'selected' : '' }}>
                                    {{ $city->Name }}
                                </option>
                            @endforeach
                        </x-form.select>
                        <x-form.error name="city_id" />
                    </div>

                    <!-- Address -->
                    <div>
                        <x-form.label for="address">warehouse Address</x-form.label>
                        <x-form.input 
                            type="text" 
                            name="address" 
                            id="address" 
                            value="{{ old('address', $warehouse->Address) }}" 
                            placeholder="Enter warehouse address"
                        />
                        <x-form.error name="address" />
                    </div>


                    <div>
                        <x-form.label for="Brochure">Warehouse Brochure</x-form.label>
                        <x-form.input type="file" name="Brochure" id="Brochure" accept="application/pdf"/>
                        <x-form.error name="Brochure" />
                    </div>

                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/warehouses" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form.button type="submit">Save</x-form.button>
        </div>
    </form>
</x-layouts.app>
