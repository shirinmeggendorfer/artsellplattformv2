<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Konversationen</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-4 sm:px-0">
            <div class="border-4 border-dashed border-gray-200 rounded-lg">
                <ul class="divide-y divide-gray-200">
                    @foreach ($conversations as $user)
                        <li class="p-4 hover:bg-gray-50 w-full">
                            <a href="{{ route('messages.conversation', $user->id) }}" class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="iconMessage" alt="{{ $user->name }}" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    @php
                                        $isBold = $user->latestMessage && !$user->latestMessage->is_read && $user->latestMessage->receiver_id == auth()->id();
                                    @endphp
                                    <p class="text-lg font-medium text-gray-900 truncate {{ $isBold ? 'font-bold' : '' }}">
                                        {{ $user->name }}
                                    </p>
                                    @if ($user->latestMessage)
                                        <p class="text-sm text-gray-500 truncate {{ $isBold ? 'font-bold' : '' }}">
                                            Letzte Nachricht: {{ $user->latestMessage->created_at->diffForHumans() }}
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-500 truncate">
                                            Keine Nachrichten
                                        </p>
                                    @endif
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Navigationsleiste -->
    <x-navbar />
</x-app-layout>
