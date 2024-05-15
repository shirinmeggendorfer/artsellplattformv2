<section>
    <header>
        <h2 class="h2-text">
            {{ __('Profil Informationen') }}
        </h2>

        <p class="mt-1 content-text">
            {{ __("Aktualisieren Sie die Profilinformationen und die E-Mail-Adresse Ihres Kontos.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profileUpdate') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <div class= "mb-2"> </div>
            <x-text-input id="name" name="name" type="text" class="block w-full p-5 h-10 content-text mb-5" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="surname" :value="__('Nachname')" />
            <div class= "mb-2"> </div>
            <x-text-input id="surname" name="surname" type="text" class="block w-full p-5 h-10 text-l mb-5" :value="old('surname', $user->surname)" required autofocus autocomplete="surname" />
            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class= "mb-2"> </div>
            <x-text-input id="email" name="email" type="email" class="block w-full p-5 h-10 text-l mb-5" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Ihre E-Mail Adresse ist nicht verifiziert.') }}

                        <x-button form="send-verification" >
                            {{ __('Klicken Sie hier, um die Bestätigungs-E-Mail erneut zu senden.') }}
                        </x-button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Ein neuer Verifizierungslink wurde an Ihre E-Mail-Adresse gesendet.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-button>{{ __('Speichern') }}</x-button>

            @if (session('status') === 'profile-updated')
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
<div class="mb-8">
