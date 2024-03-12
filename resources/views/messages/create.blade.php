{{-- resources/views/messages/create.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Write Message') }}
        </h2>
    </x-slot>

    <div class="text-left mb-2 w-full px-5">
        <h3 class="text-lg font-semibold">Message</h3>
        {{-- Nachrichtenformular --}}
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf
            {{-- Empfänger-ID (könnte versteckt sein, wenn die Route bereits den Empfänger spezifiziert) --}}
            <input type="hidden" name="recipient_id" value="{{ $recipient->id }}">

            {{-- Hier fügst du das versteckte Feld für die article_id ein --}}
            <input type="hidden" name="article_id" value="{{ $articleId }}"> {{-- Stelle sicher, dass du die Variable $articleId korrekt übergibst --}}

            {{-- Nachrichtentext --}}
            <div class="form-group">
                <textarea name="message" id="message" class="form-control w-full p-4" rows="4" required></textarea>
            </div>

            {{-- Senden-Button --}}
            <div class="flex justify-end mt-4">
                <x-primary-button type="submit" class="px-5">
                    Senden
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- Navigationsleiste -->
    <x-navbar />
</x-app-layout>
