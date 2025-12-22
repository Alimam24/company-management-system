<x-layouts.app>
    <x-slot:heading>
        Retail Store
    </x-slot>

    <div class="bg-slate-50">
        <div class="min-h-screen py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div class="mb-6 sm:mb-0">
                        <h1 class="text-4xl font-bold text-slate-900">Employee Directory</h1>
                        <p class="text-slate-600 mt-2 text-lg">Manage store employees and assignments</p>
                    </div>

                    <a href="{{ route('stores.employees.assign.page',$store) }}"
                        class="w-full sm:w-auto px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition transform hover:scale-105 active:scale-95">
                        + Assign Employee
                    </a>
                </div>

                <!-- Search + Filter Bar -->
                <form method="GET" class="mb-6 flex flex-col sm:flex-row gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name "
                        class="flex-1 px-4 py-2.5 bg-white border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 text-slate-700" />

                    <select name="department"
                        class="px-4 py-2.5 bg-white border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 text-slate-700">
                        <option value="">All Departments</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ request('department') == $department->id ? 'selected' : '' }}>
                                {{ $department->DeptName }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <!-- Table Container -->
                <div class="bg-white shadow-lg rounded-xl border border-slate-200 overflow-hidden">

                    <table class="w-full border-collapse">
                        <thead
                            class="bg-linear-to-r from-slate-50 to-slate-100 border-b border-slate-200 hidden sm:table-header-group">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Employee</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Role</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Department</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-slate-700">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($employees as $employee)
                                <!-- Desktop Row -->
                                <tr
                                    class="border-b border-slate-200 hover:bg-slate-50 transition-colors hidden sm:table-row">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $employee->person->avatar_url }}"
                                                alt="{{ $employee->person->FirstName }}"class="w-10 h-10 rounded-full object-cover">
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
                                    <td class="px-6 py-4 text-right">
                                        <form method="POST" action="{{ route('stores.employee.destroy', ['store' => $store, 'employee' => $employee]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Remove this employee?')"
                                                class="px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Mobile Card -->
                                <tr class="sm:hidden">
                                    <td class="p-0">
                                        <div class="p-4 border-b border-slate-200 hover:bg-slate-50 transition-colors">
                                            <div class="flex items-center gap-3 mb-3">
                                                <img src="{{ $employee->person->avatar_url }}"
                                                    alt="{{ $employee->person->FirstName }}"
                                                    class="w-12 h-12 rounded-full object-cover">
                                                <div class="flex-1">
                                                    <p class="font-semibold text-slate-900">
                                                        {{ $employee->person->FirstName . ' ' . $employee->person->LastName }}
                                                    </p>
                                                    <p class="text-xs text-slate-500">
                                                        ID:{{ str_pad($employee->id, 3, '0', STR_PAD_LEFT) }}</p>
                                                </div>
                                            </div>

                                            <div class="space-y-2 mb-4">
                                                <div class="flex justify-between">
                                                    <span class="text-slate-600 text-sm">Role:</span>
                                                    <span
                                                        class="inline-block px-2 py-1 bg-purple-100 text-purple-700 rounded text-xs font-medium">
                                                        {{ $employee->emp_role->RoleName }}
                                                    </span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-slate-600 text-sm">Department:</span>
                                                    <span
                                                        class="text-slate-900 text-sm">{{ $employee->department->DeptName }}</span>
                                                </div>
                                            </div>

                                            <form
                                                action="{{ route('stores.employee.destroy', ['store' => $store, 'employee' => $employee]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Remove this employee?')"
                                                class="w-full px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition">
                                                Remove
                                            </button>
                                            </form>

                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Footer Stats -->
                    <div
                        class="bg-linear-to-r from-slate-50 to-slate-100 border-t border-slate-200 px-6 py-4 flex justify-between text-sm text-slate-600">
                        <span>Total Employees: <strong class="text-slate-900">{{ $employees->count() }}</strong></span>
                        <span>Last Updated: <strong
                                class="text-slate-900">{{ now()->format('M d, Y') }}</strong></span>
                    </div>

                </div>
                <div class="mt-10">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
