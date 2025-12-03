<div class="bg-white shadow-sm rounded-md px-5 py-4 mb-6 max-w-6xl mx-auto">
    <form method="GET" action="/employees" 
          class="flex flex-col sm:flex-row gap-3 sm:items-center justify-between">

        <!-- Search input -->
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search employees by name or email..."
                class="w-full rounded-md border-gray-200 focus:border-purple-500 focus:ring-purple-500 px-4 py-2 text-sm text-gray-700 placeholder-gray-400 shadow-sm" />
        </div>

        <!-- Role filter -->
        <div>
            <select name="role"
                class="w-full sm:w-40 rounded-md border-gray-200 focus:border-purple-500 focus:ring-purple-500 px-3 py-2 text-sm text-gray-700 bg-white shadow-sm">
                <option value="">All Roles</option>
                @foreach ($roles as $role )
                     <option value="{{ $role->RoleName }}" {{ request('status') == 'active' ? 'selected' : '' }}>{{ $role->RoleName }}</option>
                @endforeach
               
            </select>
        </div>

        <!-- Status filter -->
        <div>
            <select name="status"
                class="w-full sm:w-48 rounded-md border-gray-200 focus:border-purple-500 focus:ring-purple-500 px-3 py-2 text-sm text-gray-700 bg-white shadow-sm">
                
                <option value="">All Statuses</option>
               @foreach ($states as $state )
                     <option value="{{ $state->StateName }}" {{ request('status') == 'active' ? 'selected' : '' }}>{{ $state->StateName }}</option>
                @endforeach
                
            </select>
        </div>

        <!-- Search button -->
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
