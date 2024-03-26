<div>
    <h4 class="text-lg leading-6 font-medium text-gray-900">Artikel von {{ $user->name }}</h4>
    @if($user->items->isEmpty())
    <p>Keine Artikel gefunden.</p>
    @else
    <ul>
        @foreach ($user->items as $item)
        <li class="mt-2">
            <div class="flex flex-col items-center">
                <!-- Miniaturbild oben -->
                <img src="{{ asset('storage/photos/' . $item->photo) }}" alt="{{ $item->title }}" class="w-full h-20 object-cover">
                <!-- Titel darunter -->
                <div class="text-center mb-2">{{ $item->title }}</div>
                <!-- Bearbeiten und Löschen Optionen unten -->
            
                    <a href="{{ route('admin.articles.edit', $item->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent light-color rounded-md content-text-small tracking-widest hover:accent-color active:main-color-light-mode dark:main-color-dark-mode focus:outline-none disabled:opacity-25 transition ease-in-out duration-150 br-buttons">Bearbeiten</a>
                  
              <!-- Löschen-Schaltfläche -->
    <form id="deleteForm{{ $item->id }}" method="POST" action="{{ route('admin.articles.destroy', ['item' => $item->id]) }}">
        @csrf
        @method('DELETE')
        <div class="flex items-center justify-end mt-4">
            <x-button type="button" onclick="confirmDelete({{ $item->id }})" class="text-red-500 hover:text-red-700 py-12">Artikel löschen</x-button>
        </div>
    </form>
              
            </div>
        </li>
        <div class="mb-6"></div>
        @endforeach
    </ul>
    @endif
</div>
 <!-- Include JavaScript library -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Anzeige des Löschdialogs -->
    <script>
        function confirmDelete(itemId) {
            if (confirm('Sind Sie sicher, dass Sie diesen Artikel löschen möchten?')) {
                // Formular manuell einreichen, um den Artikel zu löschen
                document.getElementById('deleteForm' + itemId).submit();
                            // Alertbox für erfolgreiche Löschung anzeigen
            alert('Die Anzeige wurde gelöscht.');
            }
        }
    </script>
    
