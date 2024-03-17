<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>


    <div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Profileinstellungen mit Accordion -->
        <div x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-2 text-left text-lg font-semibold text-gray-800 bg-gray-200 hover:bg-gray-300 rounded-md">
                <span>Profileinstellungen</span>
                <svg x-show="!open" class="iconNext h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <svg x-show="open" class="iconDown h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" x-transition class="p-4 mt-2 bg-gray-200 dark:bg-gray-800 rounded-lg">
                @include('profile.partials.update-profile-information-form')
                @include('profile.partials.update-password-form')
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->is_admin)
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-2 text-left text-lg font-semibold text-gray-800 bg-gray-200 hover:bg-gray-300 rounded-md">
                        <span>Benutzerverwaltung</span>
                        <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <svg x-show="open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="p-4 mt-2 bg-gray-200 dark:bg-gray-800 rounded-lg">
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-lg font-semibold text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-md">
                            Zum Dashboard
                        </a>
                    </div>
                </div>
            @endif

<!-- Eigene Anzeigen -->
<div class="p-4 bg-gray-200">
    <h3 class="text-lg font-semibold mb-4">Meine Anzeigen</h3>
    @if($items && $items->count() > 0)
        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($items as $item)
                <div class="bg-white rounded-lg overflow-hidden shadow">
                    <img src="{{ Storage::url($item->photo) }}" alt="{{ $item->title }}" class="w-full h-20 object-cover">
                    <div class="p-2">
                        <h5 class="font-bold text-center">{{ $item->title }}</h5>
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary">Bearbeiten</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Keine Anzeigen gefunden.</p>
    @endif
</div>


            <!-- Logout Button -->
            <div class="p-4 sm:p-8 bg-gray-200 dark:bg-gray-800">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-primary-button type="submit">
                            Logout
                        </x-primary-button>
                    </form>
                </div>
            </div>
            <div class="mb-8">

            <!-- Navigationsleiste -->
            <x-navbar />
        </div>
    </div>

    <!-- Alpine.js für das Accordion -->
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
