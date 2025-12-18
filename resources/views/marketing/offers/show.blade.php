<x-layouts.app>
    <x-slot:heading>
        {{ $offer->Title }}
    </x-slot>

    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="bg-white shadow-lg rounded-xl border border-slate-200 p-6 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 mb-2">{{ $offer->Title }}</h1>
                        @if ($offer->Description)
                            <p class="text-slate-600">{{ $offer->Description }}</p>
                        @endif
                    </div>
                    <div class="flex gap-2 mt-4 sm:mt-0">
                        <a href="{{ route('marketing.offers.assign', $offer) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Assign to Customers
                        </a>
                        <a href="{{ route('marketing.offers.edit', $offer) }}"
                            class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('marketing.offers.destroy', $offer) }}"
                            onsubmit="return confirm('Are you sure you want to delete this offer? This will also remove all customer assignments.');"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-center gap-2 text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Target: {{ $offer->customer_type ? $offer->customer_type->TypeName : 'All Customers' }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $offer->StartDate->format('M d, Y') }}
                            @if ($offer->EndDate)
                                - {{ $offer->EndDate->format('M d, Y') }}
                            @endif
                        </span>
                    </div>
                    <div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $offer->IsActive ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $offer->IsActive ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
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

            <!-- Assigned Customers -->
            <div class="bg-white shadow-lg rounded-xl border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-200">
                    <h2 class="text-xl font-semibold text-slate-900">Assigned Customers ({{ $offer->customers->count() }})</h2>
                </div>

                @if ($offer->customers->count() > 0)
                    <table class="w-full border-collapse">
                        <thead class="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Customer</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Type</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Assigned Date</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offer->customers as $customer)
                                <tr class="border-b border-slate-200 hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $customer->person->avatar_url
                                                ? asset('storage/' . $customer->person->avatar_url)
                                                : asset('storage/avatars/profile.png') }}"
                                                alt="{{ $customer->person->FirstName }}"
                                                class="w-10 h-10 rounded-full object-cover">
                                            <div>
                                                <p class="font-medium text-slate-900">
                                                    {{ $customer->person->FirstName . ' ' . $customer->person->LastName }}
                                                </p>
                                                <p class="text-xs text-slate-500">{{ $customer->person->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                                            {{ $customer->customer_type->TypeName }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-700">
                                        {{ \Carbon\Carbon::parse($customer->pivot->AssignedDate)->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form method="POST"
                                            action="{{ route('marketing.offers.remove-customer', [$offer, $customer]) }}"
                                            onsubmit="return confirm('Are you sure you want to remove this offer from the customer?');">
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
                @else
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-slate-900 mb-2">No Customers Assigned</h3>
                        <p class="text-slate-600 mb-6">This offer hasn't been assigned to any customers yet.</p>
                        <a href="{{ route('marketing.offers.assign', $offer) }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Assign to Customers
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>

</x-layouts.app>

