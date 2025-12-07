<x-layouts.app>
    <x-slot:heading>
        Assign Manager to {{ $warehouse->WarehouseName }}
    </x-slot>

    <div class="bg-slate-50">
        <div class="min-h-screen py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Header Section -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-slate-900 mb-2">Assign Manager</h1>
                    <p class="text-slate-600 text-lg">Select a manager for this warehouse. Only employees with manager role can be assigned.</p>
                </div>

                @if($currentManager)
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-sm text-blue-800">
                        <strong>Current Manager:</strong> {{ $currentManager->person->FirstName . ' ' . $currentManager->person->LastName }}
                    </p>
                </div>
                @endif

                <form method="POST" action="{{ route('warehouses.manager.assign.submit', $warehouse) }}">
                    @csrf

                    <div class="bg-white shadow-lg rounded-xl border border-slate-200 overflow-hidden">
                        <div class="p-6">
                            <label for="manager_id" class="block text-sm font-medium text-slate-700 mb-3">
                                Select Manager
                            </label>
                            
                            <select name="manager_id" id="manager_id" required
                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 text-slate-700">
                                <option value="">-- Select a Manager --</option>
                                @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}" 
                                        {{ $currentManager && $currentManager->id === $manager->id ? 'selected' : '' }}>
                                        {{ $manager->person->FirstName . ' ' . $manager->person->LastName }}
                                        @if($currentManager && $currentManager->id === $manager->id)
                                            (Current Manager)
                                        @endif
                                    </option>
                                @endforeach
                            </select>

                            @error('manager_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            @if($managers->isEmpty())
                                <p class="mt-4 text-sm text-amber-600">
                                    No available managers found. All managers are already assigned to stores or warehouses.
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="mt-6 flex gap-3">
                        <button type="submit"
                            class="px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition transform hover:scale-105 active:scale-95">
                            {{ $currentManager ? 'Change Manager' : 'Assign Manager' }}
                        </button>

                        <a href="{{ route('warehouses.show', $warehouse) }}"
                            class="px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg shadow-md transition">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

</x-layouts.app>

