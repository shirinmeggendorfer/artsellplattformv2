<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @if(auth()->user()->is_admin)
    <!-- Userverwaltung Button für Admin -->
    <div class="p-4 sm:p-8 bg-gray-200 dark:bg-gray-800">
        <div class="max-w-xl">
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Userverwaltung
            </a>
        </div>
    </div>
@endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-gray-200 dark:bg-gray-800">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-gray-200 dark:bg-gray-800">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-gray-200 dark:bg-gray-800">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
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
              
            <!-- Navigationsleiste -->
            <x-navbar />  
            
            <div class="mb-10"></div>

        </div>
    </div>
</x-app-layout>
