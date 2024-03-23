<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-10">
        <h1 class="h2-text">LogIn</h1>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email py-2" :value="__('Email')" />
            <div class= "mb-2"> </div>
            <x-text-input id="email" class="block w-full p-5 h-10 text-l mb-5" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class= "mb-2"> </div>
            <x-text-input id="password" class="block w-full p-5 h-10 text-l mb-5"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Registrierung -->
        <p class="mt-2 text-center content-text">
                    oder <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">registrieren Sie sich</a>, falls Sie noch kein Konto haben.
                </p>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 content-text-small">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline content-text-small hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-button class="ms-3">
                {{ __('Log in') }}
            </x-button>

            <!-- Navigationsleiste -->
<x-navbar />
        </div>
    </form>

</x-guest-layout>
