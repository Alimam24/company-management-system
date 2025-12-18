<x-layouts.app>
    <x-slot:heading>
        Marketing Offers
    </x-slot>

    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                <div>
                    <h1 class="text-4xl font-bold text-slate-900">Marketing Offers</h1>
                    <p class="text-slate-600 mt-2">Manage marketing offers and their assignments</p>
                </div>
                <a href="{{ route('marketing.offers.create') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition transform hover:scale-105 active:scale-95 mt-4 sm:mt-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Offer
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

            <!-- Search and Filter -->
            <div class="bg-white shadow-lg rounded-xl border border-slate-200 p-6 mb-6">
                <form method="GET" action="{{ route('marketing.offers.index') }}" class="flex flex-col sm:flex-row gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search offers..."
                        class="flex-1 px-4 py-2 border border-slate-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                    <select name="active" class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                        <option value="">All Status</option>
                        <option value="1" {{ request('active') === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('active') === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <button type="submit"
                        class="px-6 py-2 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg transition">
                        Filter
                    </button>
                    @if (request('search') || request('active'))
                        <a href="{{ route('marketing.offers.index') }}"
                            class="px-6 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <!-- Offers List -->
            @if ($offers->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($offers as $offer)
                        <div class="bg-white shadow-lg rounded-xl border border-slate-200 overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="text-xl font-bold text-slate-900">{{ $offer->Title }}</h3>
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $offer->IsActive ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $offer->IsActive ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>

                                @if ($offer->Description)
                                    <p class="text-slate-600 text-sm mb-4 line-clamp-2">{{ $offer->Description }}</p>
                                @endif

                                <div class="space-y-2 mb-4">
                                    @if ($offer->customer_type)
                                        <div class="flex items-center gap-2 text-sm text-slate-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Target: {{ $offer->customer_type->TypeName }}
                                        </div>
                                    @else
                                        <div class="flex items-center gap-2 text-sm text-slate-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Target: All Customers
                                        </div>
                                    @endif

                                    <div class="flex items-center gap-2 text-sm text-slate-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $offer->StartDate->format('M d, Y') }}
                                        @if ($offer->EndDate)
                                            - {{ $offer->EndDate->format('M d, Y') }}
                                        @endif
                                    </div>
                                </div>

                                <div class="flex gap-2 mt-4">
                                    <a href="{{ route('marketing.offers.show', $offer) }}"
                                        class="flex-1 text-center px-4 py-2 bg-purple-700 hover:bg-purple-800 text-white text-sm font-medium rounded-lg transition">
                                        View
                                    </a>
                                    <a href="{{ route('marketing.offers.edit', $offer) }}"
                                        class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 text-sm font-medium rounded-lg transition">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('marketing.offers.destroy', $offer) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this offer? This will also remove all customer assignments.');"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $offers->links() }}
                </div>
            @else
                <div class="bg-white shadow-lg rounded-xl border border-slate-200 p-12 text-center">
                    <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                    </svg>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">No Offers Found</h3>
                    <p class="text-slate-600 mb-6">Get started by creating your first marketing offer.</p>
                    <a href="{{ route('marketing.offers.create') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Create Offer
                    </a>
                </div>
            @endif

        </div>
    </div>

</x-layouts.app>

