<x-layouts.app>
    <x-slot:heading>
        Add employee
    </x-slot>

    <form method="POST" action="/employees" enctype="multipart/form-data"
          class="max-w-3xl mx-auto py-6 space-y-8">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <!-- Personal Information -->
                <h2 class="text-base font-semibold leading-7 text-gray-900">
                    Enter Personal Information:
                </h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">

                    <div>
                        <x-form.label for="avatar">Avatar Photo</x-form.label>
                        <x-form.input
                            type="file"
                            name="avatar"
                            id="avatar"
                            accept="image/*"
                        />
                        <x-form.error name="avatar" />
                    </div>

                    <div>
                        <x-form.label for="FirstName">first name</x-form.label>
                        <x-form.input
                            type="text"
                            name="FirstName"
                            id="FirstName"
                            value="{{ old('FirstName') }}"
                        />
                        <x-form.error name="FirstName" />
                    </div>

                    <div>
                        <x-form.label for="LastName">last name</x-form.label>
                        <x-form.input
                            type="text"
                            name="LastName"
                            id="LastName"
                            value="{{ old('LastName') }}"
                        />
                        <x-form.error name="LastName" />
                    </div>

                    <div>
                        <x-form.label for="NationalId">national id</x-form.label>
                        <x-form.input
                            type="text"
                            name="NationalId"
                            id="NationalId"
                            value="{{ old('NationalId') }}"
                        />
                        <x-form.error name="NationalId" />
                    </div>

                    <div>
                        <x-form.label for="email">email</x-form.label>
                        <x-form.input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                        />
                        <x-form.error name="email" />
                    </div>

                    <div>
                        <x-form.label for="phone_num">phone number</x-form.label>
                        <x-form.input
                            type="text"
                            name="phone_num"
                            id="phone_num"
                            value="{{ old('phone_num') }}"
                        />
                        <x-form.error name="phone_num" />
                    </div>

                    <div>
                        <x-form.label for="BirthDate">birth date</x-form.label>
                        <x-form.input
                            type="date"
                            name="BirthDate"
                            id="BirthDate"
                            value="{{ old('BirthDate') }}"
                        />
                        <x-form.error name="BirthDate" />
                    </div>
                </div>

                <!-- Employee Information -->
                <h2 class="text-base font-semibold leading-7 text-gray-900 mt-10">
                    Enter Employee Information:
                </h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">

                    <div>
                        <x-form.label for="emp_role_id">role</x-form.label>
                        <x-form.select name="emp_role_id" id="emp_role_id">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ old('emp_role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->RoleName }}
                                </option>
                            @endforeach
                        </x-form.select>
                        <x-form.error name="emp_role_id" />
                    </div>

                    <div>
                        <x-form.label for="dept_id">department</x-form.label>
                        <x-form.select name="dept_id" id="dept_id">
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('dept_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->DeptName }}
                                </option>
                            @endforeach
                        </x-form.select>
                        <x-form.error name="dept_id" />
                    </div>

                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ url()->previous() }}"
               class="text-sm font-semibold leading-6 text-gray-900">
                Cancel
            </a>

            <x-form.button type="submit">
                Save
            </x-form.button>
        </div>
    </form>
</x-layouts.app>
