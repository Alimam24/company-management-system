<x-layouts.app>
    <x-slot:heading>
        Customer
    </x-slot>

    <div class="bg-gray-50 min-h-screen py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Profile Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Profile Content -->
                <div class="px-6 pb-6">
                    <!-- Profile Image -->
                    <div class="flex flex-col sm:flex-row sm:items-end mb-6">
                        <img src={{ $customer->person->avatar_url }} alt="Employee Photo"
                            class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
                        <div class="mt-4 sm:mt-0 sm:ml-6 flex-1">
                            <h1 class="text-3xl font-bold text-gray-900">
                                {{ $customer->person->FirstName . ' ' . $customer->person->LastName }}</h1>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                {{ $customer->customer_type->TypeName }}
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
                                <span>{{ $customer->person->email }}</span>
                            </div>

                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <span>{{ $customer->person->phone_num }}</span>
                            </div>

                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>San Francisco, CA</span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Costomer Details</h2>

                            <div class="flex justify-between">
                                <span class="text-gray-600">customer ID:</span>
                                <span class="font-medium text-gray-900">{{ $customer->id }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600">Join Date:</span>
                                <span
                                    class="font-medium text-gray-900">{{ $customer->created_at->format('d/m/Y') }}</span>
                            </div>

                           
                        </div>
                    </div>

                    

                    <div class="flex flex-wrap items-center justify-end gap-2 pt-5 border-t border-gray-100">
                        <!-- Edit Profile -->
                        <a href="/customers/{{ $customer->id }}/edit"
                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-purple-700 text-white text-sm font-medium rounded-md shadow-sm hover:bg-purple-800 active:bg-purple-900 transition-all duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Edit
                        </a>

                        <!-- Download Resume -->
                        <button
                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md shadow-sm hover:bg-gray-200 active:bg-gray-300 transition-all duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                            </svg>
                            Download
                        </button>

                        <!-- Delete -->
                        <form method="POST" action="/customers/{{ $customer->id }}">
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
    </div>




</x-layouts.app>
