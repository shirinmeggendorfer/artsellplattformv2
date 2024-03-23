<div>
    <h4 class="text-lg leading-6 font-medium text-gray-900">Artikel von {{ $user->name }}</h4>
    @if($user->items->isEmpty())
    <p>Keine Artikel gefunden.</p>
    @else
    <ul>
        @foreach ($user->items as $item)
        <li class="mt-2">
            <div class="flex flex-col items-center">
                <!-- Miniaturbild oben -->
                <img src="{{ Storage::url($item->photo) }}" alt="{{ $item->title }}" class="w-full h-20 object-cover">
                <!-- Titel darunter -->
                <div class="text-center mb-2">{{ $item->title }}</div>
                <!-- Bearbeiten und Löschen Optionen unten -->
                <div class="flex gap-2">
                    <a href="{{ route('admin.articles.edit', $item->id) }}" class="'inline-flex items-center px-4 py-2 border border-transparent light-color rounded-md content-text-small tracking-widest hover:accent-color active:main-color-light-mode dark:main-color-dark-mode focus:outline-none disabled:opacity-25 transition ease-in-out duration-150 br-buttons">Bearbeiten</a>
                    <form action="{{ route('admin.articles.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button type="submit" class=" hover:accent-color">Löschen</x-button>
                    </form>
                </div>
            </div>
        </li>
        <div class="mb-6"></div>
        @endforeach
    </ul>
    @endif
</div>
