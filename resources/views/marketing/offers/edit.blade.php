<x-layouts.app>
    <x-slot:heading>
        Edit Marketing Offer
    </x-slot>

    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white shadow-lg rounded-xl border border-slate-200 p-8">
                <h1 class="text-3xl font-bold text-slate-900 mb-6">Edit Offer</h1>

                <form method="POST" action="{{ route('marketing.offers.update', $offer) }}">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label for="Title" class="block text-sm font-medium text-slate-700 mb-2">Title *</label>
                            <input type="text" name="Title" id="Title" value="{{ old('Title', $offer->Title) }}" required
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                            @error('Title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="Description" class="block text-sm font-medium text-slate-700 mb-2">Description</label>
                            <textarea name="Description" id="Description" rows="4"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">{{ old('Description', $offer->Description) }}</textarea>
                            @error('Description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Customer Type -->
                        <div>
                            <label for="customer_type_id" class="block text-sm font-medium text-slate-700 mb-2">Target Customer Type</label>
                            <select name="customer_type_id" id="customer_type_id"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                <option value="">All Customers</option>
                                @foreach ($customerTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('customer_type_id', $offer->customer_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->TypeName }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-sm text-slate-500">Leave empty to target all customer types</p>
                            @error('customer_type_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label for="StartDate" class="block text-sm font-medium text-slate-700 mb-2">Start Date *</label>
                            <input type="date" name="StartDate" id="StartDate" value="{{ old('StartDate', $offer->StartDate->format('Y-m-d')) }}" required
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                            @error('StartDate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="EndDate" class="block text-sm font-medium text-slate-700 mb-2">End Date</label>
                            <input type="date" name="EndDate" id="EndDate" value="{{ old('EndDate', $offer->EndDate ? $offer->EndDate->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                            <p class="mt-1 text-sm text-slate-500">Leave empty if offer has no end date</p>
                            @error('EndDate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Is Active -->
                        <div class="flex items-center">
                            <input type="checkbox" name="IsActive" id="IsActive" value="1" {{ old('IsActive', $offer->IsActive) ? 'checked' : '' }}
                                class="w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                            <label for="IsActive" class="ml-2 text-sm font-medium text-slate-700">Active</label>
                        </div>
                    </div>

                    <!-- Submit buttons -->
                    <div class="mt-8 flex gap-4">
                        <button type="submit"
                            class="px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-medium rounded-lg shadow-md transition">
                            Update Offer
                        </button>
                        <a href="{{ route('marketing.offers.show', $offer) }}"
                            class="px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>

</x-layouts.app>

