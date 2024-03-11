<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Artikel erstellen
        </h2>
    </x-slot>

        
        <form action="{{ route('items.storeItem') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="form-group px-5">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Titel</label>
                <input type="text" name="title" id="title" class="form-control w-full border-gray-300 px-4 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="form-group px-5">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Beschreibung:</label>
                <textarea name="description" id="description" rows="4" class="form-control w-full border-gray-300 px-4 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            <div class="form-group px-5">
    <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Preis:</label>
    <div class="relative flex items-center">
        <input type="number" step="0.01" name="price" id="price" class="form-control border-gray-300 px-4 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
        <div class="absolute right-3 text-gray-700 pointer-events-none">€</div>
    </div>
</div>

    
</div>

            <div class="form-group px-5">
                <label for="photo" class="block text-gray-700 text-sm font-bold mb-2">Foto:</label>
                <input type="file" name="photo" id="photo" class="form-control-file border-gray-300 px-4 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500" required>
            </div>

            <div class="flex justify-end px-5">
                <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Artikel erstellen</button>
            </div>
        </form>
    </div>

    <!-- Navigationsleiste -->
    <x-navbar />
</x-app-layout>
