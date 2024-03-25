<x-app-layout>
    <x-slot name="header">
        <h2 class="h2-text leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Begrüßung und Profilbild -->
        <div class="flex items-center space-x-4">
            <form id="profileForm" action="{{ route('profile.update-picture') }}" method="POST" enctype="multipart/form-data" class="flex items-center">
                @csrf
                <div class="px-5 relative overflow-hidden mr-4">
                    <div class="mt-4">
                        <x-label :value="__('Aktuelles Bild')" />
                        <img src="{{ asset('storage/' . ($user->profile_image ? $user->profile_image : 'profilepictures/user-2.png')) }}" alt="Aktuelles Bild" class="br-profile-picture profile-image">
                    </div>
                    <input type="file" id="profileImageInput" name="profile_image" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" onchange="submitForm()">
                </div>
                <div>
                    <p class="content-text">Hallo, {{ auth()->user()->name }}</p>
                    <x-button type="button" onclick="document.getElementById('profileImageInput').click()">Bild aktualisieren</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

           


    <div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Profileinstellungen mit Accordion -->
        <div x-data="{ open: false }">
            <x-button @click="open = !open" class="w-full flex items-center justify-between px-4 py-2 text-left h3-text light-color hover:accent-colour rounded-md">
                <span>Profileinstellungen</span>
                <svg x-show="!open" class="iconNext h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <svg x-show="open" class="iconDown h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </x-button>

            <div x-show="open" x-transition class="p-4 mt-2 light:base-color-light rounded-lg">
                @include('profile.partials.update-profile-information-form')
                @include('profile.partials.update-password-form')
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->is_admin)
                <div x-data="{ open: false }">
                    <x-button @click="open = !open" class="w-full flex items-center justify-between px-4 py-2 text-left h3-text light-color hover:accent-colour rounded-md">
                        <span>Benutzerverwaltung</span>
                        <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <svg x-show="open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </x-button>

                    <div x-show="open" x-transition class="p-4 mt-2 rounded-lg">
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 content-text-small light-color hover:accent-color br-buttons">
                            Zum Dashboard
                        </a>
                    </div>
                </div>
            @endif

<!-- Eigene Anzeigen -->
<div x-data="{ open: false }">
    <x-button @click="open = !open" class="w-full flex items-center justify-between px-4 py-2 text-left h3-text light-color hover:accent-colour rounded-md">
        <span>Meine Anzeigen</span>
        <svg x-show="!open" class="iconNext h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <svg x-show="open" class="iconDown h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </x-button>
    <div x-show="open" class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
    @if($items && $items->count() > 0)
        @foreach ($items as $item)
            <div class="light-color rounded-lg overflow-hidden shadow">
                <img src="{{ asset('storage/photos/' . $item->photo) }}" alt="{{ $item->title }}" class="w-full h-20 object-cover">
                <div class="p-2">
                    <h5 class="h3-text text-center">{{ $item->title }}</h5>
                    <div class="mt-2">
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary justify-center content-text-small w-full mb-2">Bearbeiten</a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Sind Sie sicher, dass Sie diesen Artikel löschen möchten?')" class="justify-center content-text-small btn btn-danger w-full">Löschen</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>Keine Anzeigen gefunden.</p>
    @endif 
</div>
</div>






            <!-- Logout Button -->
            <div class="p-4 sm:p-8 light:base-color-light">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-button type="submit">
                            Logout
                        </x-button>
                    </form>
                </div>
            </div>
            <div class="mb-8">

            <!-- Navigationsleiste -->
            <x-navbar />
        </div>
    </div>
    <script>
    function submitForm() {
        document.getElementById('profileForm').submit();
    }
</script>
    <!-- Alpine.js für das Accordion -->
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
