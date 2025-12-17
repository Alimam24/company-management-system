<x-layouts.app>
    <x-slot:heading>
        Employee
    </x-slot>

    <div class="bg-gray-50 min-h-screen py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Profile Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Profile Content -->
                <div class="px-6 pb-6">
                    <!-- Profile Image -->
                    <div class="flex flex-col sm:flex-row sm:items-end mb-6">
                        <img src="{{ $employee->person->avatar_url
                            ? asset('storage/' . $employee->person->avatar_url)
                            : asset('storage/avatars/profile.png') }}"
                            alt="Employee Photo" class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
                        <div class="mt-4 sm:mt-0 sm:ml-6 flex-1">
                            <h1 class="text-3xl font-bold text-gray-900">
                                {{ $employee->person->FirstName . ' ' . $employee->person->LastName }}</h1>
                            <p class="text-lg text-purple-800 font-medium">{{ $employee->emp_role->RoleName }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ $employee->department->DeptName }} Department</p>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                {{ $employee->emp_state->StateName }}
                            </span>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="space-y-4">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Contact Information</h2>

                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>{{ $employee->person->email }}</span>
                            </div>

                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <span>{{ $employee->person->phone_num }}</span>
                            </div>

                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14v7m-4 0h8a2 2 0 002-2v-5a2 2 0 00-2-2H8a2 2 0 00-2 2v5a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $employee->person->NationalId }}</span>
                            </div>


                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $employee->person->BirthDate }}</span>
                            </div>



                        </div>

                        <div class="space-y-4">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Employment Details</h2>

                            <div class="flex justify-between">
                                <span class="text-gray-600">Employee ID:</span>
                                <span class="font-medium text-gray-900">{{ $employee->id }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600">Join Date:</span>
                                <span
                                    class="font-medium text-gray-900">{{ $employee->created_at->format('d/m/Y') }}</span>
                            </div>

                            {{-- <div class="flex justify-between">
              <span class="text-gray-600">Reports To:</span>
              <span class="font-medium text-gray-900">Michael Chen</span>
            </div>

            <div class="flex justify-between">
              <span class="text-gray-600">Work Type:</span>
              <span class="font-medium text-gray-900">Full-time</span>
            </div> --}}
                        </div>
                    </div>

                    <!-- About Section -->
                    {{-- <div class="mb-8">
          <h2 class="text-xl font-semibold text-gray-900 mb-4">About</h2>
          <p class="text-gray-700 leading-relaxed">
            Sarah is a highly skilled software engineer with over 5 years of experience in full-stack development. 
            She specializes in building scalable web applications and has a strong background in React, Node.js, 
            and cloud technologies. Sarah is passionate about clean code, mentoring junior developers, and 
            contributing to open-source projects.
          </p>
        </div> --}}

                    <!-- Skills Section -->
                    {{-- <div class="mb-8">
          <h2 class="text-xl font-semibold text-gray-900 mb-4">Skills</h2>
          <div class="flex flex-wrap gap-2">
            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">JavaScript</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">React</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Node.js</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">TypeScript</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">AWS</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Docker</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">PostgreSQL</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Git</span>
          </div>
        </div> --}}

                    <div class="flex flex-wrap items-center justify-end gap-2 pt-5 border-t border-gray-100">
                        <!-- Edit Profile -->
                        <a href="/employees/{{ $employee->id }}/edit"
                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-purple-700 text-white text-sm font-medium rounded-md shadow-sm hover:bg-purple-800 active:bg-purple-900 transition-all duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Edit
                        </a>


                        @can('manage')
                        <a href={{ route('employees.change-role', $employee) }}
                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md shadow-sm hover:bg-gray-200 active:bg-gray-300 transition-all duration-150">
                            change Role
                        </a>
                        @endcan

                        <!-- Delete -->
                        <form method="POST" action="/employees/{{ $employee->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-red-700 active:bg-red-800 transition-all duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Remove
                            </button>
                        </form>
                    
                </div>
            </div>
        </div>
    </div>




</x-layouts.app>
