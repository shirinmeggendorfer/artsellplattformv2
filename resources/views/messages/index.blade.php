<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Nachrichten</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-4 sm:px-0">
            <ul class="divide-y divide-gray-400">
            @foreach ($conversations as $data)
    @php
        $latestMessage = $data['latestMessage'];
        $isUnreadClass = $data['isUnread'] ? 'font-bold' : '';
        $latestMessageDate = $data['latestMessageDate']->format('d.m.Y H:i');
        $otherUser = $data['otherUser'];
    @endphp
    <li class="{{ $isUnreadClass }}">
        <a href="{{ route('messages.conversation', ['user' => $otherUser->id, 'articleId' => $latestMessage->article_id ?? 0]) }}">
            <div class="flex items-center">
                <img src="{{ $latestMessage->article ? Storage::url($latestMessage->article->photo) : 'default-image-path.jpg' }}" alt="{{ $latestMessage->article ? $latestMessage->article->title : 'Standardtitel' }}" class="w-8 h-8 rounded-full" />
                <div class="flex-1 min-w-0 ml-4">
                    <p class="text-lg font-medium text-gray-900 truncate">{{ $latestMessage->article ? $latestMessage->article->title : 'Kein Titel verfügbar' }}</p>
                    <p class="text-sm text-gray-500">Produkt von {{ $otherUser->name }}</p>
                </div>
            </div>
            <div class="text-sm text-gray-500">{{ $latestMessageDate }}</div>
        </a>
    </li>
@endforeach


            </ul>
        </div>
    </div>

    <x-navbar :hasNewMessages="$hasNewMessages" />
</x-app-layout>
