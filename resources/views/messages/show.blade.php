<x-app-layout>
    <x-slot name="header">
        <h2 class="h2-text">Nachricht von {{ $message->sender->name }}</h2>
    </x-slot>

    <div>
        <p>{{ $message->body }}</p>
    </div>
</x-app-layout>
