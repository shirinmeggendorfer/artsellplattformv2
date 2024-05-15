<x-app-layout>
    <x-slot name="header">
        <h2 class="h2-text leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Begrüßung und Profilbild -->
            <div class="mt-4 px-5 flex items-center">
                <x-label :value="__('Aktuelles Bild')" />
                <img src="{{ asset('storage/' . ($user->profile_image ? $user->profile_image : 'profilepictures/user-2.png')) }}" alt="Aktuelles Bild" class="br-profile-picture profile-image ml-2">
                <div class="flex flex-col px-5 ml-2">
                    <span class="content-text py-5">Hallo, {{ auth()->user()->name }}</span>
                    <form id="uploadForm" method="POST" action="{{ route('profile.updatepicture') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="profile_image_input" name="profile_image" class=" hidden">
                        <x-button type="button" onclick="document.getElementById('profile_image_input').click()" class=" bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-2">
                            Bild ändern
                        </x-button>
                        <x-button type="submit" class=" bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-2" id="upload_button" style="display:none;">
                            Bild hochladen
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    document.getElementById('profile_image_input').addEventListener('change', function() {
        document.getElementById('uploadForm').submit();
    });
</script>




           


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
<div class="mb-2"></div>

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
            <div class="mb-2"></div>
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
    <div x-show="open" class="py-2 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
    @if($items && $items->count() > 0)
        @foreach ($items as $item)
            <div class="light-color rounded-lg overflow-hidden shadow">
                <img src="{{ asset('storage/photos/' . $item->photo) }}" alt="{{ $item->title }}" class="w-full h-20 object-cover">
                <div class="p-2">
                    <h5 class="h3-text text-center">{{ $item->title }}</h5>
                    <div class="mt-2">
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary justify-center content-text-small w-full mb-2">Bearbeiten</a>
                        <form id="deleteForm{{ $item->id }}" action="{{ route('items.destroy', $item->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="button" onclick="confirmDelete({{ $item->id }})" class="justify-center content-text-small btn btn-danger w-full">Löschen</button>
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
    <!-- Include JavaScript library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- Anzeige des Löschdialogs -->
<script>
    function confirmDelete(itemId) {
        if (confirm('Sind Sie sicher, dass Sie diesen Artikel löschen möchten?')) {
            // Formular manuell einreichen, um den Artikel zu löschen
            document.getElementById('deleteForm' + itemId).submit();
            // Alertbox für erfolgreiche Löschung anzeigen
            alert('Die Anzeige wurde gelöscht.');
        }
    }
</script>
    <!-- Alpine.js für das Accordion -->
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
