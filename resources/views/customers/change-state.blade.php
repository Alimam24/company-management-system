<x-layouts.app>
    <x-slot:heading>
        Add customer
    </x-slot>

    <form method="POST" action="/customers/{{ $customer->id }}/change-state" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">


                <h2 class="text-base font-semibold leading-7 text-gray-900 mt-10">Enter customer details:</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">



                    <!-- State -->
                    <div>
                        <x-form.label for="customer_state_id">Customer State</x-form.label>
                        <x-form.select name="customer_state_id" id="customer_state_id">
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}"
                                    {{ old('customer_state_id') == $state->id ? 'selected' : '' }}>
                                    {{ $state->StateName }}
                                </option>
                            @endforeach
                        </x-form.select>
                        <x-form.error name="customer_state_id" />
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/customers/{{ $customer->id }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form.button type="submit">Save</x-form.button>
        </div>
    </form>
</x-layouts.app>
