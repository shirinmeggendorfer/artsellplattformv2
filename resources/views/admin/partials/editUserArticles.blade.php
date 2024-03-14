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
                    <a href="{{ route('admin.articles.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Bearbeiten</a>
                    <form action="{{ route('admin.articles.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Löschen</button>
                    </form>
                </div>
            </div>
        </li>
        <div class="mb-6"></div>
        @endforeach
    </ul>
    @endif
</div>
