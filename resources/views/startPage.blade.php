<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Startpage</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-200 flex flex-col h-screen overflow-x-hidden">
<div class="fixed top-0 z-50 w-full mb-2 bg-gray-200 shadow">
    <!-- Fixed Suchleiste -->
    <form action="{{ route('startPage') }}" method="GET" class="flex justify-center pt-5 px-5">
        <input type="text" name="search" placeholder="Suche..." class="form-control w-full px-5 h-12 text-xl" value="{{ request('search') }}">
        <button type="submit" class="ml-2 px-5">Suchen</button>
    </form>
    <div class= mb-2></div>
</div>
<div class="pt-16">
<div class= mb-20></div>
    <h2 class="text-2xl font-bold text-left mt-4 mb-6 px-5">Last Uploads</h2>
            @foreach($items as $item)
                <a href="{{ route('items.show', $item) }}" class="px-5 w-full block text-black no-underline">
                    <img class="article-image" src="{{ Storage::url($item->photo) }}" alt="Artikel Foto">
                    <div class="px-5 py-1">
                        <div class="font-bold text-xl mb-1">{{ $item->title }}</div>
                        <p class="text-gray-900 text-base">
                            {{ number_format($item->price, 2, ',', '.') }} €
                        </p>
                    </div>
                </a>
                <div class= mb-5></div>
            @endforeach
            <div class= mb-20></div>
            </div>
<div class="fixed bottom-0 z-50 w-full">
    <!-- Fixed Navigationsleiste -->
    <x-navbar />
</div>


<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>