<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Konversation mit {{ $user->name }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        @foreach ($messages as $date => $messagesOnDate)
            <div class="px-4 py-5  shadow sm:rounded-lg sm:p-6">
                <h4 class="mb-4 font-bold text-gray-500">{{ \Carbon\Carbon::parse($date)->format('d.m.Y') }}</h4> <!-- Anzeige des Datums -->
                @foreach ($messagesOnDate as $message)
                    <div class="mb-2">
                        <p class="text-sm text-gray-900">
                            <strong>{{ $message->sender_id == auth()->id() ? 'Du' : $user->name }}:</strong>
                            {{ $message->body }}
                            <span class="ml-2 text-xs text-gray-500">{{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }}</span> <!-- Anzeige der Uhrzeit -->
                        </p>
                    </div>
                @endforeach
            </div>
        @endforeach

        <!-- Antwort-Formular -->
        <div class="mt-6 px-4 py-5  shadow sm:rounded-lg sm:p-6">
            <form action="{{ route('messages.reply', $user->id) }}" method="POST">
                @csrf
                <textarea name="body" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" placeholder="Schreibe eine Nachricht..."></textarea>
                <button type="submit" class="px-4 py-2 mt-3 font-bold text-white bg-gray-800 rounded hover:bg-gray-700">
                    Senden
                </button>
            </form>
        </div>
    </div>

    <!-- Navigationsleiste -->
    <x-navbar />
</x-app-layout>
