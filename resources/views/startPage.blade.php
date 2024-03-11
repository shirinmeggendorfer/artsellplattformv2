<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Startpage</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-200 flex flex-col h-screen">
    <form action="{{ route('startPage') }}" method="GET" class="flex justify-center pt-5 px-5">
        <input type="text" name="search" placeholder="Suche..." class="form-control w-full px-5 h-12 text-xl" value="{{ request('search') }}">
        <button type="submit" class="ml-2 px-5">Suchen</button>
    </form>

    <div class="flex flex-col items-center px-4 w-full" style="padding-top: 5%">
        @if($title)
            <div class="text-left mb-10 w-full">
                <h3 class="text-2xl font-bold">{{ $title }}</h3>
            </div>
        @endif

        <div class="flex flex-wrap justify-center">
            @foreach($items as $item)
                <a href="{{ route('items.show', $item) }}" class="m-4 w-80 rounded overflow-hidden shadow-lg block text-black no-underline">
                    <img class="article-image" src="{{ Storage::url($item->photo) }}" alt="Artikel Foto">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $item->title }}</div>
                        <p class="text-gray-900 text-base">
                            {{ number_format($item->price, 2, ',', '.') }} €
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
  

<!-- Navigationsleiste -->
<x-navbar />


<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
