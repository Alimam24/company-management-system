<x-layouts.auth>

    <!-- Login Page Content -->
    <div class=" flex justify-center mt-30 px-4">
        <div class="bg-white w-full max-w-md p-8 rounded-lg shadow-md ">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">
                Request a password reset
            </h2>

            <form class="space-y-5" method="POST" action="/password-reset-requests">
                @CSRF
                <!-- UserName -->
                <div>
                    <x-auth-form.label for="UserName">UserName</x-auth-form.label>
                    <x-auth-form.input type="text" name="UserName" id="UserName" placeholder="Enter your UserName" />
                    <x-form.error name="UserName" />
                </div>

                <x-auth-form.button>Request Password Reset</x-auth-form.button>
            </form>

            @if (session('success'))
                <div class="mt-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-end">
                <a href="/login" class="text-sm text-purple-900 hover:underline">
                    back to login
                </a>
            </div>


        </div>
    </div>

    </body>

    </html>

</x-layouts.auth>
