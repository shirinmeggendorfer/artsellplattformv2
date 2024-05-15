<x-app-layout>
    <x-slot name="header">
        <div class="light:base-color-light flex items-center space-x-4">
            <a href="{{ route('items.show', $article->id) }}" class="flex items-center no-underline">
                <img src="{{ asset('storage/photos/' . $article->photo) }}" alt="{{ $article->title }}" class="w-16 h-16 mr-4">
                <div>
                    <h2 class="h2-text">
                        {{ $article->title }}
                    </h2>
                    <p class="content-text mt-1">Verkäufer: {{ $article->user->name }}</p>
                </div>
            </a>
        </div>
    </x-slot>
<div id="messagesContainer" class=" h-screen max-h-full">
    <div class="mb-8 light:base-color-light" ></div>
    @foreach ($groupedMessages as $date => $messagesOnDate)
                <div class="px-4 py-5 sm:p-6">
                    <h4 class="mb-4 h3-text">{{ \Carbon\Carbon::parse($date)->format('d.m.Y') }}</h4>
                    @foreach ($messagesOnDate as $message)
                        <div class="mb-2 flex justify-between">
                            <div class="content-text flex-grow @if($message->sender_id == auth()->id()) light-color @else accent-color @endif p-2 br-messages">
                                <!-- Hier wird nur der erste Buchstabe des Benutzernamens angezeigt -->
                                <strong>{{ $message->sender_id == auth()->id() ? 'Du' : substr($user->name, 0, 1) }}:</strong>
                                {{ $message->body }}
                            </div>
                            <span class="content-text">{{ $message->created_at->format('H:i') }}</span>
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
        <div class="mb-60"></div>
 </div>

   
<!-- Antwort-Formular, jetzt am unteren Rand fixiert -->
<div style="position: fixed; bottom: 55px; width: 100%; background-color: #FEDCDB; max-width: 768px; light: base-color-light; padding: 10px; box-shadow: 0 -2px 10px rgba(0,0,0,0.1);">
    <form action="{{ route('messages.reply', ['user' => $user->id, 'articleId' => $articleId]) }}" method="POST" enctype="multipart/form-data" id="replyForm">
        @csrf
        <textarea name="body" class="light: base-color-light w-full px-3 py-2 content-text light-color border rounded-lg focus:outline-none" rows="4" placeholder="Schreibe eine Nachricht..."></textarea>
        
        <!-- Neues Input-Feld für Dateiuploads -->
        <div class="flex items-center">
        <input type="file" name="image" accept="image/*" class="block w-full content-text-small file:mr-4 file:py-2 file:px-4 file:br-buttons file:border-0 file:text-sm  file:bg-light-color file:text-button hover:file:accent-hover"/>
            <span class="hiddenFileName"></span> <!-- Anzeigen des ausgewählten Dateinamens -->
        </div>
        
        <div id="thumbnailContainer" class="mt-2"></div> <!-- Container für Miniaturansichten -->
        
        <x-button type="submit" class="px-4 py-2 mt-3 conten-text light-color  hover:main-color-light">Senden</x-button>
    </form>
    </div>


    <!-- JavaScript für das automatische Scrollen -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const messagesContainer = document.getElementById('messagesContainer');
            messagesContainer.scrollTo(0, -100000);
        });
    </script>


<script>
    function showThumbnail(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const thumbnailContainer = document.getElementById('thumbnailContainer');

                // Erstellen einer Miniaturansicht
                const thumbnail = document.createElement('img');
                thumbnail.src = e.target.result;
                thumbnail.alt = 'Bildvorschau';
                thumbnail.style.maxWidth = '100px';
                thumbnail.style.cursor = 'pointer';
                thumbnail.onclick = function () {
                    showImage(e.target.result);
                };

                // Hinzufügen der Miniaturansicht zum Container
                thumbnailContainer.innerHTML = ''; // Löschen aller vorherigen Miniaturansichten
                thumbnailContainer.appendChild(thumbnail);
            };

            reader.readAsDataURL(input.files[0]); // Lesen des ausgewählten Bildes als Daten-URL
        }
    }

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
        img.onclick = function () {
            this.parentElement.removeChild(this); // Entfernt das Bild bei einem Klick
        };

        // Fügt das Bild-Element dem Body hinzu
        document.body.appendChild(img);
    }

    // Verhindert das Neuladen der Seite beim Klicken auf den Button "Dateien auswählen"
    document.getElementById('fileInput').addEventListener('click', function (event) {
        event.preventDefault();
    });
</script>


    <x-navbar />
</x-app-layout>