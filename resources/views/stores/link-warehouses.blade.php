<x-layouts.app>
    <x-slot:heading>
        Retail Store – linked Warehouses
    </x-slot>

<div class="max-w-5xl mx-auto py-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-bold">
            Link Warehouses to 
            <span class="text-indigo-600">{{ $store->StoreName }}</span>
        </h2>

        <a href="{{ route('stores.show', $store) }}"
           class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
            ← Back to Store
        </a>
    </div>


    {{-- Alerts --}}
    @if(session('error'))
        <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700">
            {{ session('success') }}
        </div>
    @endif



    {{-- Card: Unlink Section --}}
    <div class="bg-white shadow rounded-xl border border-gray-200 mb-10">
        <div class="px-6 py-4 bg-purple-600 text-white rounded-t-xl">
            <h3 class="text-lg font-semibold">Linked Warehouses</h3>
        </div>

        <div class="p-6">

            @if(empty($linkedIds))
                <p class="text-gray-500">No warehouses linked to this store.</p>
            @else
                <ul class="space-y-3">
                    @foreach($warehouses->filter(fn($w) => in_array($w->id, $linkedIds)) as $linked)
                        <li class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border">
                            <span class="font-medium">
                                {{ $linked->WarehouseName }}
                                @if($linked->city)
                                    <span class="text-gray-500"> ({{ $linked->city->Name }})</span>
                                @endif
                            </span>

                            <form method="POST" 
                                  action="{{ route('stores.warehouses.unlink', [$store, $linked]) }}"
                                  onsubmit="return confirm('Are you sure you want to unlink this warehouse?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1.5 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition">
                                    Unlink
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif

        </div>
    </div>





    {{-- Card: Select & Link Warehouses --}}
    <div class="bg-white shadow rounded-xl mb-8 border border-gray-200">
        <div class="px-6 py-4 border-b bg-purple-600 text-white rounded-t-xl">
            <h3 class="text-lg font-semibold">Select Warehouses</h3>
        </div>

        <div class="p-6">

            <p class="text-gray-600 mb-4">Choose which warehouses should be linked to this store.</p>

            <form method="POST" action="{{ route('stores.warehouses.link.submit', $store) }}">
                @csrf

                <div class="space-y-2 mb-6">
                    @foreach($warehouses as $warehouse)
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer border hover:bg-gray-100 transition">
                            <input 
                                type="checkbox"
                                name="warehouses[]" 
                                value="{{ $warehouse->id }}"
                                class="w-4 h-4 text-indigo-600 rounded"
                                {{ in_array($warehouse->id, $linkedIds) ? 'checked' : '' }}
                            >
                            <span class="ml-3 font-medium text-gray-800">
                                {{ $warehouse->WarehouseName }}
                                @if($warehouse->city)
                                    <span class="text-gray-500"> ({{ $warehouse->city->Name }})</span>
                                @endif
                            </span>
                        </label>
                    @endforeach
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Save Changes
                    </button>
                    <a href="{{ route('stores.show', $store) }}"
                       class="px-5 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>


    

</div>
</x-layouts.app>
