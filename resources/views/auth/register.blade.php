<x-guest-layout>
    <div class="text-center mb-10">
        <h1 class="text-xl font-bold">Register</h1>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <div class= "mb-2"> </div>
            <x-text-input id="name" class="block w-full p-5 h-10 text-l mb-5" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

         <!-- Nachname -->
         <div>
            <x-input-label for="surname" :value="__('Nachname')" />
            <div class= "mb-2"> </div>
            <x-text-input id="surname" class="block w-full p-5 h-10 text-l mb-5" type="text" name="surname" :value="old('surname')" required autofocus autocomplete="surname" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <div class= "mb-2"> </div>
            <x-text-input id="email" class="block w-full p-5 h-10 text-l mb-5" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class= "mb-2"> </div>

            <x-text-input id="password" class="block w-full p-5 h-10 text-l mb-5"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <div class= "mb-2"> </div>
            <x-text-input id="password_confirmation" class="block w-full p-5 h-10 text-l mb-5"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>  
        </div>
    </form>
    <!-- Navigationsleiste -->
<x-navbar />
</x-guest-layout>
