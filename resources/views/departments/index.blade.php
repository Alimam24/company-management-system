<x-layouts.app>
    <x-slot:heading>
        Departments
    </x-slot>

    <div class="bg-gray-50 min-h-screen p-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($departments as $department)
                <a href="{{ route('departments.show', $department) }}">
                    <!-- Department Card -->
                    <article
                        class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6 border border-gray-200 flex flex-col h-48 overflow-hidden">

                        <!-- Department Name -->
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 truncate">{{ $department->DeptName }}</h2>

                        <!-- Department Details -->
                        <div class="space-y-3 flex-1 overflow-hidden">
                            <!-- Employee Count -->
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-500">Employees</p>
                                    <p class="text-2xl font-bold text-purple-700">{{ $department->employees_count }}</p>
                                </div>
                            </div>

                            <!-- Description (if available) -->
                            @if($department->Description)
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-gray-500 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="flex-1 truncate">
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ $department->Description }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </article>
                </a>
            @endforeach
        </div>
    </div>

</x-layouts.app>

