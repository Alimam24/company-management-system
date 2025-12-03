<x-layouts.app>
    <x-slot:heading>
        Add customer
    </x-slot>

    <form method="POST" action="/customers">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Enter Personal Information:</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                    <div>
                        <x-form.label for="FirstName">First name</x-form.label>
                        <x-form.input type="text" name="FirstName" id="FirstName" value="{{ old('FirstName') }}" />
                        <x-form.error name="FirstName" />
                    </div>

                    <div>
                        <x-form.label for="LastName">Last name</x-form.label>
                        <x-form.input type="text" name="LastName" id="LastName" value="{{ old('LastName') }}" />
                        <x-form.error name="LastName" />
                    </div>

                    <div>
                        <x-form.label for="NationalId">National ID</x-form.label>
                        <x-form.input type="text" name="NationalId" id="NationalId" value="{{ old('NationalId') }}" />
                        <x-form.error name="NationalId" />
                    </div>

                    <div>
                        <x-form.label for="email">Email</x-form.label>
                        <x-form.input type="email" name="email" id="email" value="{{ old('email') }}" />
                        <x-form.error name="email" />
                    </div>

                    <div>
                        <x-form.label for="phone_num">Phone number</x-form.label>
                        <x-form.input type="text" name="phone_num" id="phone_num" value="{{ old('phone_num') }}" />
                        <x-form.error name="phone_num" />
                    </div>

                    <div>
                        <x-form.label for="BirthDate">Birth date</x-form.label>
                        <x-form.input type="date" name="BirthDate" id="BirthDate" value="{{ old('BirthDate') }}" />
                        <x-form.error name="BirthDate" />
                    </div>
                </div>

                <h2 class="text-base font-semibold leading-7 text-gray-900 mt-10">Enter customer details:</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                    <!-- Type -->
                    <div>
                        <x-form.label for="customer_type_id">Customer Type</x-form.label>
                        <x-form.select name="customer_type_id" id="customer_type_id">
                            <option value="">Select Type</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" 
                                    {{ old('customer_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->TypeName }}
                                </option>
                            @endforeach
                        </x-form.select>
                        <x-form.error name="customer_type_id" />
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
