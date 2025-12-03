<x-layouts.app>
    <x-slot:heading>
        Edit Customer: {{ $customer->person->FirstName . ' ' . $customer->person->LastName }}
    </x-slot>

    <form method="POST" action="/customers/{{ $customer->id }}">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                    <!-- First Name -->
                    <div>
                        <x-form.label for="FirstName">First Name</x-form.label>
                        <x-form.input type="text" name="FirstName" id="FirstName"
                            value="{{ old('FirstName', $customer->person->FirstName) }}" />
                        <x-form.error name="FirstName" />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <x-form.label for="LastName">Last Name</x-form.label>
                        <x-form.input type="text" name="LastName" id="LastName"
                            value="{{ old('LastName', $customer->person->LastName) }}" />
                        <x-form.error name="LastName" />
                    </div>

                    <!-- National ID -->
                    <div>
                        <x-form.label for="NationalId">National ID</x-form.label>
                        <x-form.input type="text" name="NationalId" id="NationalId"
                            value="{{ old('NationalId', $customer->person->NationalId) }}" />
                        <x-form.error name="NationalId" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-form.label for="email">Email</x-form.label>
                        <x-form.input type="email" name="email" id="email"
                            value="{{ old('email', $customer->person->email) }}" />
                        <x-form.error name="email" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-form.label for="phone_num">Phone Number</x-form.label>
                        <x-form.input type="text" name="phone_num" id="phone_num"
                            value="{{ old('phone_num', $customer->person->phone_num) }}" />
                        <x-form.error name="phone_num" />
                    </div>

                    <!-- Birth Date -->
                    <div>
                        <x-form.label for="BirthDate">Birth Date</x-form.label>
                        <x-form.input type="date" name="BirthDate" id="BirthDate"
                            value="{{ old('BirthDate', $customer->person->BirthDate) }}" />
                        <x-form.error name="BirthDate" />
                    </div>
                </div>

                <h2 class="text-base font-semibold leading-7 text-gray-900 mt-10">customer Information</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                    <!-- Type -->
                    <div>
                        <x-form.label for="customer_type_id">Customer Type</x-form.label>
                        <x-form.select name="customer_type_id" id="customer_type_id">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @selected($customer->customer_type_id == $type->id)>
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
            <a href="" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form.button type="submit">Save</x-form.button>
        </div>
    </form>
</x-layouts.app>
