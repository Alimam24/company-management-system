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
                        <img src="{{ $customer->person->avatar_url
                            ? asset('storage/' . $customer->person->avatar_url)
                            : asset('storage/avatars/profile.png') }}"
                            alt="Employee Photo" class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
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
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14v7m-4 0h8a2 2 0 002-2v-5a2 2 0 00-2-2H8a2 2 0 00-2 2v5a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $customer->person->NationalId }}</span>
                            </div>


                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $customer->person->BirthDate }}</span>
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

                            <div class="flex justify-between">
                                <span class="text-gray-600">customer state:</span>
                                <span
                                    class="font-medium text-gray-900">{{ $customer->customer_state->StateName }}</span>
                            </div>


                        </div>
                    </div>

                    <!-- Marketing Employee Assignment (VIP Only) -->
                    @if ($customer->customer_type->TypeName === 'VIP')
                        <div class="mb-8 pt-6 border-t border-gray-200">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-xl font-semibold text-gray-900">Marketing Employee</h2>
                                <a href="{{ route('marketing.assign-employee', $customer) }}"
                                    class="inline-flex items-center gap-1.5 px-4 py-2 bg-purple-700 text-white text-sm font-medium rounded-md shadow-sm hover:bg-purple-800 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                    {{ $customer->marketingEmployee ? 'Change Assignment' : 'Assign Employee' }}
                                </a>
                            </div>

                            @if ($customer->marketingEmployee && $customer->marketingEmployee->employee)
                                <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $customer->marketingEmployee->employee->person->avatar_url
                                            ? asset('storage/' . $customer->marketingEmployee->employee->person->avatar_url)
                                            : asset('storage/avatars/profile.png') }}"
                                            alt="Marketing Employee"
                                            class="w-12 h-12 rounded-full object-cover">
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900">
                                                {{ $customer->marketingEmployee->employee->person->FirstName . ' ' . $customer->marketingEmployee->employee->person->LastName }}
                                            </p>
                                            <p class="text-sm text-gray-600">{{ $customer->marketingEmployee->employee->person->email }}</p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $customer->marketingEmployee->employee->department->DeptName }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                                    <p class="text-gray-600 text-sm">No marketing employee assigned</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Marketing Offers -->
                    <div class="mb-8 pt-6 border-t border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Marketing Offers</h2>

                        @if ($customer->offers->count() > 0)
                            <div class="space-y-3">
                                @foreach ($customer->offers as $offer)
                                    <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h3 class="font-semibold text-gray-900">{{ $offer->Title }}</h3>
                                                @if ($offer->Description)
                                                    <p class="text-sm text-gray-600 mt-1">{{ $offer->Description }}</p>
                                                @endif
                                                <div class="flex items-center gap-4 mt-2 text-xs text-gray-500">
                                                    <span>Assigned: {{ \Carbon\Carbon::parse($offer->pivot->AssignedDate)->format('M d, Y') }}</span>
                                                    @if ($offer->EndDate)
                                                        <span>Valid until: {{ $offer->EndDate->format('M d, Y') }}</span>
                                                    @endif
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $offer->IsActive ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                        {{ $offer->IsActive ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                                <p class="text-gray-600 text-sm">No offers assigned to this customer</p>
                            </div>
                        @endif
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

                        @can('manage')
                        <a href="/customers/{{ $customer->id }}/change-state"
                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md shadow-sm hover:bg-gray-200 active:bg-gray-300 transition-all duration-150">
                            change state
                        </a>
                        @endcan

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
