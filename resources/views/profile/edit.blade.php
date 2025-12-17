<x-layouts.app>
    <x-slot:heading>
        Edit Employee: {{ $employee->person->FirstName . ' ' . $employee->person->LastName }}
    </x-slot>

    <form method="POST" action="/profile" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">

                    <div>
                        <x-form.label for="avatar">Avatar Photo</x-form.label>
                        <x-form.input type="file" name="avatar" id="avatar" accept="image/*" />
                        <x-form.error name="avatar" />
                    </div>

                    <!-- First Name -->
                    <div>
                        <x-form.label for="FirstName">First Name</x-form.label>
                        <x-form.input type="text" name="FirstName" id="FirstName"
                            value="{{ old('FirstName', $employee->person->FirstName) }}" />
                        <x-form.error name="FirstName" />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <x-form.label for="LastName">Last Name</x-form.label>
                        <x-form.input type="text" name="LastName" id="LastName"
                            value="{{ old('LastName', $employee->person->LastName) }}" />
                        <x-form.error name="LastName" />
                    </div>

                    <!-- National ID -->
                    <div>
                        <x-form.label for="NationalId">National ID</x-form.label>
                        <x-form.input type="text" name="NationalId" id="NationalId"
                            value="{{ old('NationalId', $employee->person->NationalId) }}" />
                        <x-form.error name="NationalId" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-form.label for="email">Email</x-form.label>
                        <x-form.input type="email" name="email" id="email"
                            value="{{ old('email', $employee->person->email) }}" />
                        <x-form.error name="email" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-form.label for="phone_num">Phone Number</x-form.label>
                        <x-form.input type="text" name="phone_num" id="phone_num"
                            value="{{ old('phone_num', $employee->person->phone_num) }}" />
                        <x-form.error name="phone_num" />
                    </div>

                    <!-- Birth Date -->
                    <div>
                        <x-form.label for="BirthDate">Birth Date</x-form.label>
                        <x-form.input type="date" name="BirthDate" id="BirthDate"
                            value="{{ old('BirthDate', $employee->person->BirthDate) }}" />
                        <x-form.error name="BirthDate" />
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/profile" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form.button type="submit">Save</x-form.button>
        </div>
    </form>
</x-layouts.app>
