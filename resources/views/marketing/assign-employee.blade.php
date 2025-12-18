<x-layouts.app>
    <x-slot:heading>
        Assign Marketing Employee to {{ $customer->person->FirstName . ' ' . $customer->person->LastName }}
    </x-slot>

    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="bg-white shadow-lg rounded-xl border border-slate-200 p-6 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 mb-2">Assign Marketing Employee</h1>
                        <p class="text-slate-600">Customer: {{ $customer->person->FirstName . ' ' . $customer->person->LastName }}</p>
                        <p class="text-sm text-purple-600 font-medium mt-1">VIP Customer</p>
                    </div>
                    <a href="{{ route('customers.show', $customer) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition mt-4 sm:mt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Customer
                    </a>
                </div>

                @if ($currentAssignment)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <p class="text-sm text-blue-800">
                            <strong>Current Assignment:</strong> 
                            {{ $currentAssignment->employee->person->FirstName . ' ' . $currentAssignment->employee->person->LastName }}
                            ({{ $currentAssignment->employee->department->DeptName }})
                        </p>
                    </div>
                @endif
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

            <!-- Marketing Employees List -->
            @if ($marketingEmployees->count() > 0)
                <form method="POST" action="{{ route('marketing.assign-employee.submit', $customer) }}">
                    @csrf

                    <div class="bg-white shadow-lg rounded-xl border border-slate-200 overflow-hidden">
                        <div class="p-6 border-b border-slate-200">
                            <h2 class="text-xl font-semibold text-slate-900">Select Marketing Employee</h2>
                            <p class="text-sm text-slate-600 mt-1">Choose a marketing employee to assign to this VIP customer</p>
                        </div>

                        <div class="divide-y divide-slate-200">
                            @foreach ($marketingEmployees as $employee)
                                <label class="flex items-center p-6 hover:bg-slate-50 cursor-pointer transition-colors">
                                    <input type="radio" name="employee_id" value="{{ $employee->id }}"
                                        class="w-5 h-5 text-purple-600 border-slate-300 focus:ring-purple-500"
                                        {{ $currentAssignment && $currentAssignment->employee_id == $employee->id ? 'checked' : '' }}>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $employee->person->avatar_url
                                                ? asset('storage/' . $employee->person->avatar_url)
                                                : asset('storage/avatars/profile.png') }}"
                                                alt="{{ $employee->person->FirstName }}"
                                                class="w-12 h-12 rounded-full object-cover">
                                            <div class="flex-1">
                                                <p class="font-medium text-slate-900">
                                                    {{ $employee->person->FirstName . ' ' . $employee->person->LastName }}
                                                </p>
                                                <p class="text-sm text-slate-600">{{ $employee->person->email }}</p>
                                                <p class="text-xs text-slate-500 mt-1">
                                                    {{ $employee->department->DeptName }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="mt-6 flex gap-4">
                        <button type="submit"
                            class="px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition transform hover:scale-105 active:scale-95">
                            {{ $currentAssignment ? 'Update Assignment' : 'Assign Employee' }}
                        </button>
                        @if ($currentAssignment)
                            <form method="POST" action="{{ route('marketing.remove-employee', $customer) }}"
                                onsubmit="return confirm('Are you sure you want to remove the marketing employee assignment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg shadow-md transition">
                                    Remove Assignment
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('customers.show', $customer) }}"
                            class="px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition">
                            Cancel
                        </a>
                    </div>
                </form>
            @else
                <div class="bg-white shadow-lg rounded-xl border border-slate-200 p-12 text-center">
                    <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">No Marketing Employees Available</h3>
                    <p class="text-slate-600 mb-6">There are no marketing employees in the system.</p>
                    <a href="{{ route('customers.show', $customer) }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Customer
                    </a>
                </div>
            @endif

        </div>
    </div>

</x-layouts.app>

