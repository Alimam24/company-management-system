<x-layouts.app>
    <x-slot:heading>
        Change Password
    </x-slot>

    <form method="POST" action="/profile/change-password">
        @csrf
        @method('POST')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Change Password</h2>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-1">

                    <!-- Old Password -->
                    <div>
                        <x-form.label for="current_password">Enter old password</x-form.label>
                        <x-form.input type="password" name="current_password" id="current_password"
                            value="{{ old('current_password') }}" />
                        <x-form.error name="current_password" />
                    </div>

                    <!-- New Password -->
                    <div>
                        <x-form.label for="new_password">Enter new password</x-form.label>
                        <x-form.input type="password" name="new_password" id="new_password"
                            value="{{ old('new_password') }}" />
                        <x-form.error name="new_password" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-form.label for="new_password_confirmation">Confirm new password</x-form.label>
                        <x-form.input type="password" name="new_password_confirmation" id="new_password_confirmation"
                            value="{{ old('new_password_confirmation') }}" />
                        <x-form.error name="new_password_confirmation" />
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('profile.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form.button type="submit">Save</x-form.button>
        </div>
    </form>
</x-layouts.app>
