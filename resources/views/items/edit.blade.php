
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Artikel bearbeiten: {{ $item->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-200 border-b border-gray-200">
                <form method="POST" action="{{ route('items.update', ['item' => $item->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Titel -->
                        <div>
                        <x-input-label for="title" :value="__('Titel')" />
            <div class= "mb-2"> </div>
                            <x-label for="title" :value="__('Titel')" />
                            <x-input id="title" class="block w-full p-5 h-10 text-l mb-5" type="text" name="title" value="{{ $item->title }}" required autofocus />
                        </div>
             
                        <div class= "mb-6"> </div>

                        <!-- Beschreibung -->
                       
                        <x-input-label for="description" :value="__('Beschreibung')" />
            <div class= "mb-2"> </div>
                            <x-label for="description" :value="__('Beschreibung')" />
                            <textarea id="description" name="description" rows="4" class="block w-full p-5 text-l mb-5">{{ $item->description }}</textarea>
                        

                          <div class= "mb-6"> </div>
                        <!--  Bild  -->


                        @if($item->photo)
                            <div class="mt-4">
                                <x-label :value="__('Aktuelles Bild')" />
                                <img src="{{ Storage::url($item->photo) }}" alt="Aktuelles Bild" class="w-48 h-auto">
                            </div>
                        @endif

                        <!-- Bild -->
                        <div class="mt-4">
                            <x-label for="photo" :value="__('Neues Bild hochladen')" />
                            <x-input id="photo" class="block mt-1 w-full" type="file" name="photo" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                        <x-primary-button>{{ __('Speichern') }}</x-primary-button>
                        </div>
                    </form>
                </div>
    
            </div>
        </div>
    </div>
       <!-- Fixed Navigationsleiste -->
       <x-navbar />
</x-app-layout>
