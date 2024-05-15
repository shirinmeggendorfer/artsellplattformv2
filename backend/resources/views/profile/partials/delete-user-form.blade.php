<section class="space-y-6">
    <header>
        <h2 class="h2-text">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 content-text">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Profil löschen') }}</x-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profileDestroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="content-text">
                {{ __('Möchtest du wirklich dein Profil löschen?') }}
            </h2>

            <p class="mt-1 content-text">
                {{ __('Sobald Ihr Konto gelöscht ist, werden alle Ressourcen und Daten dauerhaft gelöscht. Bitte geben Sie Ihr Passwort ein, um zu bestätigen, dass Sie Ihr Konto endgültig löschen möchten.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Abbrechen') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Profil löschen') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
