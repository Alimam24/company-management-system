<x-layouts.auth>

    <!-- Login Page Content -->
    <div class=" flex justify-center mt-30 px-4">
        <div class="bg-white w-full max-w-md p-8 rounded-lg shadow-md ">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">
                Login to your account
            </h2>

            <form class="space-y-5" method="POST" action="/login">
                @CSRF
                <!-- Email -->
                <div>
                    <x-auth-form.label for="UserName">UserName</x-auth-form.label>
                    <x-auth-form.input type="text" name="UserName" id="UserName" placeholder="Enter your email" />
                    <x-form.error name="UserName" />
                </div>


                <!-- Password -->
                <div>
                    <x-auth-form.label for="password">Password</x-auth-form.label>
                    <x-auth-form.input type="password" name="password" id="password"
                        placeholder="Enter your password" />
                    <x-form.error name="password" />
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center space-x-2 text-sm text-gray-600">
                        <input type="checkbox" class="rounded border-gray-300">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-purple-900 hover:underline">
                        Forgot password?
                    </a>
                </div>

                <x-auth-form.button>login</x-auth-form.button>
            </form>


        </div>
    </div>

    </body>

    </html>

</x-layouts.auth>
