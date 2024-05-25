<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <!-- Removed validation errors display -->

        <!-- Removed session status display -->

        <form method="POST" action="{{ route('login') }}">
            <!-- Removed CSRF token -->
            @csrf

            <div>
                <label for="email" value="Email">Email</label>
                <input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            </div>

            <div class="mt-4">
                <label for="password" value="Password">Password</label>
                <input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input type="checkbox" id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <!-- Removed password reset link -->

                <button class="ml-4">
                    Log in
                </button>
            </div>
        </form>

        <x-slot name="anchor">
            Don't have an account yet. <a class="underline" href="{{ route('register') }}">Sign up</a> now.
        </x-slot>

    </x-jet-authentication-card>
</x-guest-layout>

