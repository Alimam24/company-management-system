<x-layouts.app>
    <x-slot:heading>
        Assign {{ $offer->Title }} to Customers
    </x-slot>

    <div class="bg-slate-50">
        <div class="min-h-screen py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div class="mb-6 sm:mb-0">
                        <h1 class="text-4xl font-bold text-slate-900">Assign Offer to Customers</h1>
                        <p class="text-slate-600 mt-2">Select customers to assign "{{ $offer->Title }}"</p>
                        @if ($offer->customer_type)
                            <p class="text-sm text-purple-600 font-medium mt-1">
                                Target: {{ $offer->customer_type->TypeName }} customers only
                            </p>
                        @endif
                    </div>
                    <a href="{{ route('marketing.offers.show', $offer) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Offer
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

                @if ($customers->count() > 0)
                    <form method="POST" action="{{ route('marketing.offers.assign.submit', $offer) }}">
                        @csrf

                        <!-- Table Container -->
                        <div class="bg-white shadow-lg rounded-xl border border-slate-200 overflow-hidden">

                            <table class="w-full border-collapse">
                                <thead
                                    class="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-200 hidden sm:table-header-group">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Select</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Customer</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Type</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($customers as $customer)
                                        <!-- Desktop Row -->
                                        <tr class="border-b border-slate-200 hover:bg-slate-50 transition-colors hidden sm:table-row">
                                            <td class="px-6 py-4">
                                                <input type="checkbox" name="customers[]" value="{{ $customer->id }}"
                                                    class="w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                                            </td>
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
                                        </tr>

                                        <!-- Mobile Card -->
                                        <tr class="sm:hidden">
                                            <td class="p-0">
                                                <div class="p-4 border-b border-slate-200 hover:bg-slate-50 transition-colors">
                                                    <div class="flex justify-between items-center mb-3">
                                                        <input type="checkbox" name="customers[]" value="{{ $customer->id }}"
                                                            class="w-5 h-5 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                                                        <img src="{{ $customer->person->avatar_url
                                                            ? asset('storage/' . $customer->person->avatar_url)
                                                            : asset('storage/avatars/profile.png') }}"
                                                            alt="{{ $customer->person->FirstName }}"
                                                            class="w-12 h-12 rounded-full object-cover">
                                                    </div>
                                                    <div class="space-y-2">
                                                        <div class="flex justify-between">
                                                            <span class="text-slate-600 text-sm">Name:</span>
                                                            <span class="text-slate-900 text-sm font-medium">
                                                                {{ $customer->person->FirstName . ' ' . $customer->person->LastName }}
                                                            </span>
                                                        </div>
                                                        <div class="flex justify-between">
                                                            <span class="text-slate-600 text-sm">Type:</span>
                                                            <span
                                                                class="inline-block px-2 py-1 bg-purple-100 text-purple-700 rounded text-xs font-medium">
                                                                {{ $customer->customer_type->TypeName }}
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
                                Assign Selected Customers
                            </button>
                            <a href="{{ route('marketing.offers.show', $offer) }}"
                                class="px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition">
                                Cancel
                            </a>
                        </div>
                    </form>

                    <div class="mt-10">
                        {{ $customers->links() }}
                    </div>
                @else
                    <div class="bg-white shadow-lg rounded-xl border border-slate-200 p-12 text-center">
                        <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-slate-900 mb-2">No Customers Available</h3>
                        <p class="text-slate-600 mb-6">
                            @if ($offer->customer_type)
                                All {{ $offer->customer_type->TypeName }} customers already have this offer assigned.
                            @else
                                All customers already have this offer assigned.
                            @endif
                        </p>
                        <a href="{{ route('marketing.offers.show', $offer) }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Offer
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>

</x-layouts.app>

