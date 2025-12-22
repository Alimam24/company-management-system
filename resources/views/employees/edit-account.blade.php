<x-layouts.app>
    <x-slot:heading>
        Create Account for: {{ $employee->person->FirstName . ' ' . $employee->person->LastName }}
    </x-slot>

    <form method="POST" action="/employees/{{ $employee->id }}/update-account">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Account Information</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-1">


                    <!-- UserName -->
                    <div>
                        <x-form.label for="UserName">User Name</x-form.label>
                        <x-form.input type="text" name="UserName" id="UserName"
                            value="{{ old('UserName', $employee->user->UserName ?? '') }}" />
                        <x-form.error name="UserName" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-form.label for="password">Password</x-form.label>
                        <x-form.input type="password" name="password" id="password"
                            value="{{ old('password') }}" />
                        <x-form.error name="password" />
                    </div>

                    <!--Active-->
                    <div>
                        <x-form.label for="Is_Active">Active</x-form.label>
                        <x-form.select name="Is_Active" id="Is_Active">
                            <option value="1" {{ old('Is_Active') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('Is_Active') == '0' ? 'selected' : '' }}>No</option>
                        </x-form.select>
                        <x-form.error name="Is_Active" />
                    </div>


                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('employees.show', $employee->id) }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form.button type="submit">Save</x-form.button>
        </div>
    </form>
</x-layouts.app>
