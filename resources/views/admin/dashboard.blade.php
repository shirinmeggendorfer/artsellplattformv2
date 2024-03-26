<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Admin-Dashboard</h2>
    </x-slot>

    <div class="py-4  min-h-screen">
        <div class="max-w-md mx-auto px-4">
            <div class="light:base-color-light ">
                <div class="px-4  sm:px-6">
                    <h3 class="h3-text">Benutzerverwaltung</h3>
                </div>

   <!-- Suchformular -->
   <form action="{{ route('admin.searchUser') }}" method="GET" class="flex justify-center pt-5 px-">
                        <x-text-input type="text" name="search" placeholder="Benutzer suchen..." class="form-control w-full px-5 h-12 text-xl"/>
                        <x-button type="submit" class="ml-2 px-5">Suchen</x-button>
                    </form>
                    <div class= "mb-6"> </div>
                </div>


                <div class="border-t">
    @foreach($users as $user)
    <div x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-2 text-left content-text hover:accent-color">
            <span>{{ $user->name }}</span>
            <svg x-show="!open" class="iconNext h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <svg x-show="open" class="iconDown h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
        <div x-show="open" x-transition class="p-4 mt-2 light:base-color-light rounded-lg">
            <!-- Akkordeon für Profilinformationen -->
            <div x-data="{ openForm: false }">
                <button @click="openForm = !openForm" class="w-full flex items-center justify-between px-4 py-2 text-left content-text hover:accent-color">
                    <span>Profilinformationen</span>
                    <svg x-show="!openForm" class="iconNext h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <svg x-show="openForm" class="iconDown h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openForm" x-transition class="p-4 mt-2 light:base-color-light rounded-lg">
                    @include('admin.partials.editUserForm', ['user' => $user])
                </div>
            </div>
            <!-- Akkordeon für Artikel -->
            <div x-data="{ openArticles: false }">
                <button @click="openArticles = !openArticles" class="w-full flex items-center justify-between px-4 py-2 text-left content-text hover:accent-color">
                    <span>Artikel</span>
                    <svg x-show="!openArticles" class="iconNext h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <svg x-show="openArticles" class="iconDown h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openArticles" x-transition class="p-4 mt-2 light:base-color-light rounded-lg">
                    @include('admin.partials.editUserArticles', ['user' => $user])
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

            </div>
        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
       <!-- Fixed Navigationsleiste -->
       <x-navbar />
</x-app-layout>