<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <!-- Removed validation errors display -->

        <form method="POST" action="{{ route('register') }}">
            <!-- Removed CSRF token -->
            @csrf

            <div>
                <label for="name">Name</label>
                <input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
            </div>

            <div class="mt-4">
                <label for="username">Username</label>
                <input id="username" class="block mt-1 w-full" type="text" name="username" required />
            </div>

            <div class="mt-4">
                <label for="email">Email</label>
                <input id="email" class="block mt-1 w-full" type="email" name="email" required />
            </div>

            <div class="mt-4">
                <label for="password">Password</label>
                <input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <div class="mt-4">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <!-- Removed terms and privacy policy agreement -->

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    Already registered?
                </a>

                <button class="ml-4">
                    Register
                </button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

