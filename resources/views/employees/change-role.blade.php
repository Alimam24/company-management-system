<x-layouts.app>
    <x-slot:heading>
        Edit Employee Information: {{ $employee->person->FirstName . ' ' . $employee->person->LastName }}
    </x-slot>

    <form method="POST" action="/employees/{{ $employee->id }} " enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <h2 class="text-base font-semibold leading-7 text-gray-900 mt-10">Employee Information</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                    <!-- Role -->
                    <div>
                        <x-form.label for="emp_role_id">Role</x-form.label>
                        <x-form.select name="emp_role_id" id="emp_role_id">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @selected($employee->emp_role_id == $role->id)>
                                    {{ $role->RoleName }}
                                </option>
                            @endforeach
                        </x-form.select>
                        <x-form.error name="emp_role_id" />
                    </div>

                    <!-- Department -->
                    <div>
                        <x-form.label for="dept_id">Department</x-form.label>
                        <x-form.select name="dept_id" id="dept_id">
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}" @selected($employee->department_id == $dept->id)>
                                    {{ $dept->DeptName }}
                                </option>
                            @endforeach
                        </x-form.select>
                        <x-form.error name="dept_id" />
                    </div>

                    <!-- State -->
                    <div>
                        <x-form.label for="emp_state_id">Status</x-form.label>
                        <x-form.select name="emp_state_id" id="emp_state_id">
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" @selected($employee->emp_state_id == $state->id)>
                                    {{ $state->StateName }}
                                </option>
                            @endforeach
                        </x-form.select>
                        <x-form.error name="emp_state_id" />
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
