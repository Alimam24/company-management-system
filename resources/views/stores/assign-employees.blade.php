<x-layouts.app>
    <x-slot:heading>
        Assign Employees to {{ $store->StoreName }}
    </x-slot>

    <div class="bg-slate-50">
        <div class="min-h-screen py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div class="mb-6 sm:mb-0">
                        <h1 class="text-4xl font-bold text-slate-900">Assign Employees</h1>
                    </div>


                </div>




                <form method="POST" action="{{ route('stores.employees.assign.submit', $store) }}">
                    @csrf

                    <!-- Table Container -->
                    <div class="bg-white shadow-lg rounded-xl border border-slate-200 overflow-hidden">

                        <table class="w-full border-collapse">
                            <thead
                                class="bg-linear-to-r from-slate-50 to-slate-100 border-b border-slate-200 hidden sm:table-header-group">
                                <tr>
                                    <!--CHECKBOX HEADER -->
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                                        Select
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Employee</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Role</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Department</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($employees as $employee)
                                    <!-- Desktop Row -->
                                    <tr
                                        class="border-b border-slate-200 hover:bg-slate-50 transition-colors hidden sm:table-row">

                                        <!-- NEW DESKTOP CHECKBOX -->
                                        <td class="px-6 py-4">
                                            <input type="checkbox" name="employees[]" value="{{ $employee->id }}"
                                                class="w-4 h-4 text-purple-600 border-slate-300 rounded">
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ $employee->person->avatar_url }}"
                                                    alt="{{ $employee->person->FirstName }}"
                                                    class="w-10 h-10 rounded-full object-cover">
                                                <div>
                                                    <p class="font-medium text-slate-900">
                                                        {{ $employee->person->FirstName . ' ' . $employee->person->LastName }}
                                                    </p>
                                                    <p class="text-xs text-slate-500">ID: {{ $employee->id }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center gap-2 px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-medium">
                                                {{ $employee->emp_role->RoleName }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 text-slate-700">{{ $employee->department->DeptName }}</td>


                                    </tr>

                                    <!-- Mobile Card -->
                                    <tr class="sm:hidden">
                                        <td class="p-0">
                                            <div
                                                class="p-4 border-b border-slate-200 hover:bg-slate-50 transition-colors">

                                                <!-- MOBILE CHECKBOX -->
                                                <div class="flex justify-between items-center mb-3">
                                                    <input type="checkbox" name="employees[]"
                                                        value="{{ $employee->id }}"
                                                        class="w-5 h-5 text-purple-600 border-slate-300 rounded">

                                                    <img src="{{ $employee->person->avatar_url }}"
                                                        alt="{{ $employee->person->FirstName }}"
                                                        class="w-12 h-12 rounded-full object-cover">
                                                </div>

                                                <div class="space-y-2 mb-4">
                                                    <div class="flex justify-between">
                                                        <span class="text-slate-600 text-sm">Name:</span>
                                                        <span class="text-slate-900 text-sm">
                                                            {{ $employee->person->FirstName . ' ' . $employee->person->LastName }}
                                                        </span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-slate-600 text-sm">Role:</span>
                                                        <span
                                                            class="inline-block px-2 py-1 bg-purple-100 text-purple-700 rounded text-xs font-medium">
                                                            {{ $employee->emp_role->RoleName }}
                                                        </span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-slate-600 text-sm">Department:</span>
                                                        <span class="text-slate-900 text-sm">
                                                            {{ $employee->department->DeptName }}
                                                        </span>
                                                    </div>
                                                </div>



                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <!-- Submit button -->
                    <button
                        class="mt-6 w-full sm:w-auto px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition transform hover:scale-105 active:scale-95">
                        Assign Selected Employees
                    </button>

                </form>

                <div class="mt-10">
                    {{-- {{ $employees->links() }} --}}
                </div>

            </div>
        </div>
    </div>

</x-layouts.app>
