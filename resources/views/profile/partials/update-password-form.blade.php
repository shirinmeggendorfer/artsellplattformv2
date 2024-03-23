<section>
    <header>
        <h2 class="h2-text">
            {{ __('Passtwort ändern') }}
        </h2>

        <p class="mt-1 content-text">
            {{ __('Stellen Sie sicher, dass Ihr Konto ein langes, zufälliges Passwort verwendet, um sicher zu sein.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <div class= "mb-2"> </div>
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="block w-full p-5 h-10 text-l mb-5" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <div class= "mb-2"> </div>
            <x-text-input id="update_password_password" name="password" type="password" class="block w-full p-5 h-10 text-l mb-5" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <div class= "mb-2"> </div>
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full p-5 h-10 text-l mb-5" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-button>{{ __('Speichern') }}</x-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Speichern.') }}</p>
            @endif
        </div>
    </form>
    <div class="mb-10">
</section>
