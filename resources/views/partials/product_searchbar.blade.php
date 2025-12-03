<div class="bg-white shadow-sm rounded-md px-5 py-4 mb-6 max-w-6xl mx-auto">
    <form method="GET" action="/products" 
          class="flex flex-col sm:flex-row gap-3 sm:items-center justify-between">

        <!-- Search by Name -->
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search products by name..."
                class="w-full rounded-md border-gray-200 focus:border-purple-500 focus:ring-purple-500 px-4 py-2 text-sm text-gray-700 placeholder-gray-400 shadow-sm" />
        </div>

        <!-- Price Range -->
        <div class="flex gap-2">
            <input type="number" name="min_price" value="{{ request('min_price') }}" step="0.01"
                placeholder="Min Price"
                class="w-20 rounded-md border-gray-200 focus:border-purple-500 focus:ring-purple-500 px-3 py-2 text-sm text-gray-700 placeholder-gray-400 shadow-sm" />
            <input type="number" name="max_price" value="{{ request('max_price') }}" step="0.01"
                placeholder="Max Price"
                class="w-20 rounded-md border-gray-200 focus:border-purple-500 focus:ring-purple-500 px-3 py-2 text-sm text-gray-700 placeholder-gray-400 shadow-sm" />
        </div>

        <!-- Search Button -->
        <div>
            <button type="submit"
                class="bg-purple-900 hover:bg-purple-800 text-white font-medium px-4 py-2 rounded-md text-sm flex items-center justify-center gap-1 transition w-full sm:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                <span>Search</span>
            </button>
        </div>
    </form>
</div>
