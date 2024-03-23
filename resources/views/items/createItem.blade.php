<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Artikel erstellen
        </h2>
    </x-slot>



        
        <form action="{{ route('items.storeItem') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
        <div class="px-5">
            
            <div>
                <x-input-label for="title" :value="__('Titel')" />
                <div class= "mb-2"> </div>
                <x-text-input id="title" class="block w-full p-5 h-10 text-l mb-5" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Beschreibung')" />
                <div class= "mb-2"> </div>
                <x-text-input id="description" rows="4" class="form-control w-full border-gray-300 px-4 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:accent-color" type="text" name="description" :value="old('description')" required autofocus autocomplete="description" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="price" :value="__('Preis')" />
                <div class= "mb-2"> </div>
                <x-text-input id="price" class="block w-full p-5 h-10 text-l mb-5" type="number" step="0.01" name="price" :value="old('price')" required autofocus autocomplete="price" />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <div>

            <div class="form-group px-5">
                <label for="photo" class="block text-gray-700 text-sm font-bold mb-2">Foto:</label>
                <input type="file" name="photo" id="photo" class="form-control-file border-gray-300 px-4 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500" required>
            </div>


</div>

</div>

           

            <div class="flex px-5">
                <x-button type="submit" class="content-text py-2 px-4 ">Artikel erstellen</x-button>
            </div>
        </form>
    </div>


    <!-- Navigationsleiste -->
    <x-navbar />
</x-app-layout>