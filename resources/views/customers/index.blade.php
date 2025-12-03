<x-layouts.app>
    <x-slot:heading>
        customers
    </x-slot>

    @include('partials.customer_searchbar')



    @foreach ($customers as $customer)
       <div
    class="bg-white shadow-xl shadow-gray-100 w-full max-w-4xl mx-auto flex flex-col sm:flex-row gap-3 sm:items-center justify-between px-5 py-4 rounded-md mb-2.5">
    
    <!-- Left side: Customer info -->
    <div class="flex items-center gap-4">
        <img src="{{ $customer->person->avatar_url }}" alt="Customer photo"
            class="w-14 h-14 rounded-full object-cover ring-2 ring-purple-100" />

        <div>
            <h3 class="font-bold mt-px text-gray-900">
                {{ $customer->person->FirstName . ' ' . $customer->person->LastName }}
            </h3>
            <div class="flex items-center gap-3 mt-2">
                <span class="bg-purple-100 text-purple-700 rounded-full px-3 py-1 text-sm">
                    {{ $customer->customer_type->TypeName }}
                </span>
            </div>
        </div>
    </div>

    <!-- Right side: Action -->
    <div>
        <a href="/customers/{{ $customer->id }}"
            class="bg-purple-900 text-white font-medium px-4 py-2 rounded-md flex gap-1 items-center hover:bg-purple-800 transition">
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
        {{ $customers->links() }}
    </div>
</x-layouts.app>
