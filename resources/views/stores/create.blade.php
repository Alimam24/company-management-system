<x-layouts.app>
    <x-slot:heading>
        Add Retail Store
    </x-slot>

    <form method="POST" action="/stores" enctype="multipart/form-data">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Enter store details:</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                    <div>
                        <x-form.label for="StoreName">store name</x-form.label>
                        <x-form.input type="text" name="StoreName" id="StoreName" />
                        <x-form.error name="StoreName" />
                    </div>

                    <div>
                        <x-form.label for="phone">Store phone number</x-form.label>
                        <x-form.input type="text" name="phone" id="phone" />
                        <x-form.error name="phone" />
                    </div>

                    <div>
                        <x-form.label for="city_id">City</x-form.label>
                        <x-form.select name="city_id" id="city_id">
                           
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->Name }}</option>
                            @endforeach
                        </x-form.select>
                        <x-form.error name="city_id" />
                    </div>
                    <div>
                        <x-form.label for="Address">Store address</x-form.label>
                        <x-form.input type="text" name="Address" id="Address" />
                        <x-form.error name="Address" />
                    </div>


                    <div>
                        <x-form.label for="Brochure">Store Brochure</x-form.label>
                        <x-form.input type="file" name="Brochure" id="Brochure" accept="application/pdf"/>
                        <x-form.error name="Brochure" />
                    </div>







                </div>



            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <x-form.button type="submit">Save</x-form.button>
        </div>
    </form>
</x-layouts.app>
