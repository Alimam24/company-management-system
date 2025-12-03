<x-layouts.app>
    <x-slot:heading>
        employees 
    </x-slot>

    @include('partials.emp_searchbar')



    @foreach ($employees as $employee)
        <div
            class="bg-white shadow-xl shadow-gray-100 w-full mx-auto flex flex-col sm:flex-row gap-3 sm:items-center justify-between px-5 py-4 rounded-md mb-2.5">
            <!-- Left side: Employee info -->
            <div class="flex items-center gap-4">
                <img src={{ $employee->person->avatar_url }} alt="Employee photo"
                    class="w-14 h-14 rounded-full object-cover ring-2 ring-purple-100" />

                <div>
                    <span class="text-purple-800 text-sm font-medium">{{ $employee->department->DeptName }}</span>
                    <h3 class="font-bold mt-px text-gray-900">
                        {{ $employee->person->FirstName . ' ' . $employee->person->LastName }}</h3>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="bg-purple-100 text-purple-700 rounded-full px-3 py-1 text-sm">
                            {{ $employee->emp_role->RoleName }}
                        </span>
                        <span class="text-slate-600 text-sm flex gap-1 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $employee->emp_state->StateName }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Right side: Contact or Action -->
            <div>
                <a
                     href="/employees/{{ $employee['id'] }}" class="bg-purple-900 text-white font-medium px-4 py-2 rounded-md flex gap-1 items-center hover:bg-purple-800 transition">
                    View Profile
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    @endforeach
    <div>
        {{ $employees->links() }}
    </div>
</x-layouts.app>
