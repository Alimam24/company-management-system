<x-layouts.app>
    <x-slot:heading>
        {{ $department->DeptName }}
    </x-slot>

    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Department Info Section -->
            <div class="bg-white shadow-lg rounded-xl border border-slate-200 p-6 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 mb-2">{{ $department->DeptName }}</h1>
                        @if ($department->Description)
                            <p class="text-slate-600">{{ $department->Description }}</p>
                        @endif
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('departments.assign-employees', $department) }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition transform hover:scale-105 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Assign Employees
                        </a>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="font-medium">{{ $department->employees->count() }} Employee(s)</span>
                </div>
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

            <!-- Employees Table -->
            @if ($department->employees->count() > 0)
                <div class="bg-white shadow-lg rounded-xl border border-slate-200 overflow-hidden">
                    <table class="w-full border-collapse">
                        <thead class="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Employee</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Role</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">State</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($department->employees as $employee)
                                <!-- Desktop Row -->
                                <tr class="border-b border-slate-200 hover:bg-slate-50 transition-colors">
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
                                                <p class="text-xs text-slate-500">{{ $employee->person->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-medium">
                                            {{ $employee->emp_role->RoleName }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-700">{{ $employee->emp_state->StateName }}</td>
                                    <td class="px-6 py-4">
                                        <form method="POST"
                                            action="{{ route('departments.employee.remove', [$department, $employee]) }}"
                                            onsubmit="return confirm('Are you sure you want to remove this employee from {{ $department->DeptName }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 font-medium text-sm flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-white shadow-lg rounded-xl border border-slate-200 p-12 text-center">
                    <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">No Employees Assigned</h3>
                    <p class="text-slate-600 mb-6">This department doesn't have any employees assigned yet.</p>
                    <a href="{{ route('departments.assign-employees', $department) }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Assign Employees
                    </a>
                </div>
            @endif

        </div>
    </div>

</x-layouts.app>
