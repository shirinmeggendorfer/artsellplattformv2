<x-app-layout>
    <x-slot name="header">
        <h2 class="h2-text leading-tight">
            {{ __('startPage') }}
        </h2>
    </x-slot>



<div class="light:base-color-light fixed top-0 z-50 w-full mb-2 shadow">
        <!-- Fixed Suchleiste -->
        <form id="searchForm" action="{{ route('startPage') }}" method="GET" class="base-color-light flex justify-center pt-5 px-5">
            <x-text-input type="text" name="search" id="searchInput" placeholder="Suche..." class="form-control w-full px-5 h-12 content-text light-color dark-placeholder" value="{{ request('search') }}"/>
            <x-button type="button" id="searchButton" class="ml-2 px-5 accent-color">Suchen</x-button>
        </form>
        

        <div class= mb-2></div>
    </div>
    <!--Logo -->
    <div class="pt-16">
        <div class="flex justify-between items-center px-5 py-5">
            <div class="websiteLogo"></div>
            <span class="h1-text">AppName</span>
        </div>
        <div class= mb-20></div>
        <h2 class="h2-text text-left mt-4 mb-6 px-5">zuletzt hochgeladen</h2>
        @foreach($items as $item)
            <a href="{{ route('items.show', $item) }}" class="px-5 w-full block text-black no-underline">
                <img class="article-image" src="{{ Storage::url($item->photo) }}" alt="Artikel Foto">
                <div class="px-5 py-1">
                    <div class="h3-text mb-1">{{ $item->title }}</div>
                    <p class="content-text">
                        {{ number_format($item->price, 2, ',', '.') }} €
                    </p>
                </div>
            </a>
            <div class= mb-5></div>
        @endforeach
        <div class= mb-20></div>
    </div>
    <div class="fixed bottom-0 z-50 w-full">
        <!-- Fixed Navigationsleiste -->
        <x-navbar />
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/checkMessages.js') }}"></script>
    <script>
        // Erkennt das Farbschema des Betriebssystems

    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            document.getElementById('searchForm').submit();
        });
    </script>
    </x-app-layout>
