<x-layouts.app>
    <x-slot:heading>
        Assign Employees to {{ $department->DeptName }}
    </x-slot>

    <div class="bg-slate-50">
        <div class="min-h-screen py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div class="mb-6 sm:mb-0">
                        <h1 class="text-4xl font-bold text-slate-900">Assign Employees</h1>
                        <p class="text-slate-600 mt-2">Select employees to assign to {{ $department->DeptName }}</p>
                    </div>
                    <a href="{{ route('departments.show', $department) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Department
                    </a>
                </div>

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($employees->count() > 0)
                    <form method="POST" action="{{ route('departments.assign-employees.submit', $department) }}">
                        @csrf

                        <!-- Table Container -->
                        <div class="bg-white shadow-lg rounded-xl border border-slate-200 overflow-hidden">

                            <table class="w-full border-collapse">
                                <thead
                                    class="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-200 hidden sm:table-header-group">
                                    <tr>
                                        <!--CHECKBOX HEADER -->
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                                            Select
                                        </th>

                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Employee
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Role</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Current
                                            Department</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">State</th>
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
                                                    class="w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                                            </td>

                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <img src="{{ $employee->person->avatar_url
                                                        ? asset('storage/' . $employee->person->avatar_url)
                                                        : asset('storage/avatars/profile.png') }}"
                                                        alt="{{ $employee->person->FirstName }}"
                                                        class="w-10 h-10 rounded-full object-cover">
                                                    <div>
                                                        <p class="font-medium text-slate-900">
                                                            {{ $employee->person->FirstName . ' ' . $employee->person->LastName }}
                                                        </p>
                                                        <p class="text-xs text-slate-500">
                                                            {{ $employee->person->email }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex items-center gap-2 px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-medium">
                                                    {{ $employee->emp_role->RoleName }}
                                                </span>
                                            </td>

                                            <td class="px-6 py-4 text-slate-700">{{ $employee->department->DeptName }}
                                            </td>

                                            <td class="px-6 py-4 text-slate-700">{{ $employee->emp_state->StateName }}
                                            </td>

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
                                                            class="w-5 h-5 text-purple-600 border-slate-300 rounded focus:ring-purple-500">

                                                        <img src="{{ $employee->person->avatar_url }}"
                                                            alt="{{ $employee->person->FirstName }}"
                                                            class="w-12 h-12 rounded-full object-cover">
                                                    </div>

                                                    <div class="space-y-2 mb-4">
                                                        <div class="flex justify-between">
                                                            <span class="text-slate-600 text-sm">Name:</span>
                                                            <span class="text-slate-900 text-sm font-medium">
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
                                                        <div class="flex justify-between">
                                                            <span class="text-slate-600 text-sm">State:</span>
                                                            <span class="text-slate-900 text-sm">
                                                                {{ $employee->emp_state->StateName }}
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
                        <div class="mt-6 flex gap-4">
                            <button type="submit"
                                class="px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition transform hover:scale-105 active:scale-95">
                                Assign Selected Employees
                            </button>
                            <a href="{{ route('departments.show', $department) }}"
                                class="px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition">
                                Cancel
                            </a>
                        </div>

                    </form>

                    <div class="mt-10">
                        {{ $employees->links() }}
                    </div>
                @else
                    <div class="bg-white shadow-lg rounded-xl border border-slate-200 p-12 text-center">
                        <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-slate-900 mb-2">No Employees Available</h3>
                        <p class="text-slate-600 mb-6">All employees are already assigned to this department.</p>
                        <a href="{{ route('departments.show', $department) }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Department
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>

</x-layouts.app>
