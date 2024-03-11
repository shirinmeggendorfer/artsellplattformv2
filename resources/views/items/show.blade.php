<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Einzelansicht
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class=" sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $item->title }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Verkäufer: {{ $item->user->name }}
                </p>
            </div>
            <div class="border-t border-gray-200">
                
                    <div class="bg-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <img src="{{ Storage::url($item->photo) }}" alt="Artikelbild" class="w-full h-auto">
                        </dd>
                    </div>
                    <div class="mb-5"></div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Beschreibung
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $item->description }}
                        </dd>
                    </div>
                    <div class="mb-5"></div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium text-gray-500">
        Preis
    </dt>
    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
        {{ number_format($item->price, 2, ',', '.') }} €
    </dd>
</div>

                
            </div>
        </div>

        <div class="mt-5 flex justify-end px-5">
    @if(auth()->check())
        <a href="{{ route('messages.create', ['recipient' => $item->user->id]) }}" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded no-underline">
            Anschreiben
        </a>
    @else
        <a href="{{ route('login') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded no-underline">
            Anschreiben
        </a>
    @endif
</div>


    </div>
    <div class="mb-20"></div>

    <!-- Navigationsleiste -->
    <x-navbar />
</x-app-layout>
