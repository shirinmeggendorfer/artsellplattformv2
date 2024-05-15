<x-app-layout>
    <x-slot name="header">
        <h2 class="h2-text leading-tight">
            Artikel bearbeiten: {{ $item->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6  border-b border-gray-200">
                <form method="POST" action="{{ route('items.update', ['item' => $item->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Titel -->
                        <div>
                        <x-input-label for="title" :value="__('Titel')" />
            <div class= "mb-2"> </div>
                            <x-label for="title" :value="__('Titel')" />
                            <x-input id="title" class="block w-full p-5 h-10 content-text light-color mb-5" type="text" name="title" value="{{ $item->title }}" required autofocus />
                        </div>
             
                        <div class= "mb-6"> </div>

                        <!-- Beschreibung -->
                       
                        <x-input-label for="description" :value="__('Beschreibung')" />
            <div class= "mb-2"> </div>
                            <x-label for="description" :value="__('Beschreibung')" />
                            <textarea id="description" name="description" rows="4" class="block w-full p-5 content-text light-color mb-5">{{ $item->description }}</textarea>
                        

                          <div class= "mb-6"> </div>
                        <!--  Bild  -->


                        @if($item->photo)
                            <div class="mt-4">
                                <x-label :value="__('Aktuelles Bild')" />
                                <img src="{{ asset('storage/photos/' . $item->photo) }}" alt="Aktuelles Bild" class="w-48 content-text h-auto">
                            </div>
                        @endif

                        <!-- Bild -->
                        <div class="mt-4">
                            <x-label for="photo" :value="__('Neues Bild hochladen')" />
                            <x-input id="photo" class="block content-text-small mt-1 w-full" type="file" name="photo" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                        <x-button>{{ __('Speichern') }}</x-button>
                        </div>
                    </form>
                </div>
    
            </div>
        </div>
    </div>
       <!-- Fixed Navigationsleiste -->
       <x-navbar />
</x-app-layout>