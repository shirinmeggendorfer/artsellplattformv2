<x-app-layout>
    <x-slot name="header">
        <h2 class="h2-text">Nachrichten</h2>
    </x-slot>
    <ul class="divide-y divide-light-color">
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <ul class="divide-y divide-light-color">
        <div class="px-4 py-4 sm:px-0">
        
           

            @foreach ($conversations as $data)
    @php
        $latestMessage = $data['latestMessage'];
        $isUnreadClass = $data['isUnread'] ? 'font-bold light-color unread' : '';
        $latestMessageDate = $data['latestMessageDate']->format('d.m.Y H:i');
        $otherUser = $data['otherUser'];
    @endphp
    <li class="{{ $isUnreadClass }}">
        <a href="{{ route('messages.conversation', ['user' => $otherUser->id, 'articleId' => $latestMessage->article_id ?? 0]) }}">
            <div class="flex items-center">
            <img src="{{ $latestMessage->article ? asset('storage/photos/' . $latestMessage->article->photo) : asset('default-image-path.jpg') }}" alt="{{ $latestMessage->article ? $latestMessage->article->title : 'Standardtitel' }}" class="w-8 h-8" />

                <div class="flex-1 min-w-0 ml-4">
                    <p class="h3-text">{{ $latestMessage->article ? $latestMessage->article->title : 'Kein Titel verfügbar' }}</p>
                    <p class="content-text">Produkt von {{ $otherUser->name }}</p>
                </div>
                <div class="ml-12 content-text">{{ $latestMessageDate }}</div>
            </div>
        <div class="flex-1 light-color w-full">  </div>
        </a>
    </li>
    <ul class="divide-y divide-light-color">
    <div class="mb-2"></div>
@endforeach

            </ul>
        </div>
    </div>

    <x-navbar :hasNewMessages="$hasNewMessages" />
</x-app-layout>
