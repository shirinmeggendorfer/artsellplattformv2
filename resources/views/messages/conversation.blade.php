<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('items.show', $article->id) }}" class="flex items-center no-underline">
                <img src="{{ Storage::url($article->photo) }}" alt="{{ $article->title }}" class="w-16 h-16 mr-4">
                <div>
                    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        {{ $article->title }}
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">Verkäufer: {{ $article->user->name }}</p>
                </div>
            </a>
        </div>
    </x-slot>

    @foreach ($groupedMessages as $date => $messagesOnDate)
<div class="px-4 py-5 sm:p-6">
    <h4 class="mb-4 font-bold text-gray-500">{{ \Carbon\Carbon::parse($date)->format('d.m.Y') }}</h4>
    @foreach ($messagesOnDate as $message)
        <div class="mb-2 flex justify-between">
            <p class="text-sm text-gray-900 flex-grow">
                <strong>{{ $message->sender_id == auth()->id() ? 'Du' : $user->name }}:</strong>
                {{ $message->body }}
            </p>
            <span class="text-sm text-gray-500">{{ $message->created_at->format('H:i') }}</span>
        </div>
        @if($message->image_path)
            <div class="text-right">
                <!-- Kleinere Bildvorschau im Chat -->
                <img src="{{ Storage::url($message->image_path) }}" alt="Bild" style="max-width: 100px; cursor: pointer;" onclick="showImage('{{ Storage::url($message->image_path) }}')">
            </div>
        @endif
    @endforeach
</div>
@endforeach

    </div>
    <div class="mb-80"></div>

    <!-- Antwort-Formular, jetzt am unteren Rand fixiert -->
    <div style="position: fixed; bottom: 55px; width: 100%; max-width: 768px; background: #f3f4f6; padding: 10px; box-shadow: 0 -2px 10px rgba(0,0,0,0.1);">
        <form action="{{ route('messages.reply', ['user' => $user->id, 'articleId' => $articleId]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <textarea name="body" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" placeholder="Schreibe eine Nachricht..."></textarea>
            <!-- Neues Input-Feld für Dateiuploads -->
            <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"/>
            <button type="submit" class="px-4 py-2 mt-3 font-bold text-white bg-gray-800 rounded hover:bg-gray-700">Senden</button>
        </form>
    </div>

    <script>
        // Automatisches Scrollen zum unteren Teil des Nachrichtenbereichs
        document.addEventListener("DOMContentLoaded", function() {
        // Definiert, wie oft gescrollt werden soll
        const numberOfScrolls = 5;
        let currentScroll = 0;

        // Funktion, die das Scrollen durchführt
        function scrollDown() {
            const messagesContainer = document.getElementById('messagesContainer');
            if (messagesContainer && currentScroll < numberOfScrolls) {
                messagesContainer.scrollTop = messagesContainer.scrollHeight+1000;
                currentScroll++;
                setTimeout(scrollDown, 100); // Wiederholt nach einer kurzen Verzögerung
     
            }
        }

        // Startet das Scrollen beim Laden der Seite
        scrollDown();
    });

        function showImage(src) {
    // Erstellen eines neuen Bild-Elements
    const img = new Image();
    img.src = src;
    img.style.maxWidth = '80%';
    img.style.maxHeight = '80%';
    img.style.position = 'fixed';
    img.style.top = '50%';
    img.style.left = '50%';
    img.style.transform = 'translate(-50%, -50%)';
    img.style.zIndex = '10000';
    img.style.cursor = 'zoom-out'; // Ändert den Cursor zum Zoom-Out-Symbol
    img.onclick = function() {
        this.parentElement.removeChild(this); // Entfernt das Bild bei einem Klick
    };

    // Fügt das Bild-Element dem Body hinzu
    document.body.appendChild(img);
}
    </script>
<div class="mb-60"></div>

    <x-navbar />
</x-app-layout>
