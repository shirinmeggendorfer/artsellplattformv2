{{-- resources/views/messages/create.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="h2-text leading-tight">
            {{ __('Write Message') }}
        </h2>
    </x-slot>

    <div class="text-left mb-2 w-full px-5">
        <h3 class="text-lg h2-text">Neue Nachricht</h3>
        {{-- Nachrichtenformular --}}
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf  
            <input type="hidden" name="recipient_id" value="{{ $recipient->id }}">
            <input type="hidden" name="article_id" value="{{ $articleId }}"> 

            {{-- Nachrichtentext --}}
            <div class="form-group">
                <textarea name="message" id="message" class="form-control content-text w-full p-4" rows="4" required></textarea>
            </div>

            {{-- Senden-Button --}}
            <div class="flex justify-end mt-4">
                <x-button type="submit" class="px-5">
                    Senden
                </x-button>
            </div>
        </form>
    </div>

    <!-- Navigationsleiste -->
    <x-navbar />
</x-app-layout>
