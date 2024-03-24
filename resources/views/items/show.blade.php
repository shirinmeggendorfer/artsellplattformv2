<x-app-layout>
    <x-slot name="header">
        <h2 class="h2-text">
            Produktansicht
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="h3-text">
                    {{ $item->title }}
                </h3>
                <p class="mt-1 max-w-2xl content-text">
                    Verkäufer: {{ $item->user->name }}
                </p>
            </div>
            <div class="border-t border-gray-200">
                <div class=" px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="content-text">
                    </dt>
                    <dd class="mt-1 content-text sm:mt-0 sm:col-span-2">
                    <img src="{{ asset('storage/photos/' . $item->photo) }}" alt="Artikelbild" class="w-full h-auto">
                    </dd>
                </div>
                <div class="mb-5"></div>
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="h3-text">
                        Beschreibung
                    </dt>
                    <dd class="mt-1 content-text sm:mt-0 sm:col-span-2">
                        {{ $item->description }}
                    </dd>
                </div>
                <div class="mb-5"></div>
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="content-text">
                        Preis
                    </dt>
                    <dd class="mt-1 content-text sm:mt-0 sm:col-span-2">
                        {{ number_format($item->price, 2, ',', '.') }} €
                    </dd>
                </div>
            </div>
        </div>

        <div class="mt-5 flex justify-end px-5">
            @if(auth()->check())
                <a href="{{ route('messages.create', ['recipient' => $item->user->id, 'articleId' => $item->id]) }}" class="light-color hover:accent-color content-text-small py-2 px-4 br-buttons">
                    Anschreiben
                </a>
            @else
                <a href="{{ route('login') }}" class="light-color hover:accent-color content-text py-2 px-4 br-buttons no-underline">
                    Anschreiben
                </a>
            @endif
        </div>

    </div>
    <div class="mb-20"></div>

    <!-- Navigationsleiste -->
    <x-navbar />
</x-app-layout>
