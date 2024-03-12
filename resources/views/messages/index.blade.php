<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Konversationen</h2>
    </x-slot>
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-4 sm:px-0">
                <ul class="divide-y divide-gray-400">
                @foreach ($flattenedConversations as $conversation)
                    @php
                        $article = $conversation->article;
                        $otherUser = $conversation->sender_id == auth()->id() ? $conversation->recipient : $conversation->sender;
                        $messageDate = $conversation->created_at->format('d.m.Y H:i');
                    @endphp
                    @if($article && $otherUser)
                        <li class="p-4 hover:bg-gray-50 w-full flex items-center justify-between">
                            <a href="{{ route('messages.conversation', ['user' => $otherUser->id, 'articleId' => $article->id]) }}" class="flex items-center space-x-4">
                                <img src="{{ Storage::url($article->photo) }}" alt="{{ $article->title }}" class="w-8 h-8 rounded-full" />
                                <div class="flex-1 min-w-0">
                                    <p class="text-lg font-medium text-gray-900 truncate">{{ $article->title }}</p>
                                    <p class="text-sm text-gray-500">Produkt von {{ $otherUser->name }}</p>
                                </div>
                                <div class="text-sm text-gray-500">{{ $messageDate }}</div>
                            </a>
                        </li>
                    @endif
                @endforeach
                </ul>
        </div>
    </div>

    <x-navbar />
</x-app-layout>
