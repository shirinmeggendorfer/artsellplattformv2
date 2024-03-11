<!DOCTYPE html>
<html lang="de">
<head>
      <!-- CURRENTLY NOT USED  -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200 flex flex-col h-screen">

<div class="flex flex-col px-4 w-full" style="padding-top: 5%;">
    <!-- Slogan Bereich -->
    <div class="text-center mb-10">
        <h1 class="text-xl font-bold">Profile</h1>
    </div>
    <div class= mb-5></div>
    <h1 class="text-left text-xl">Willkommen</h1>
    <div class= mb-20></div>
    <!-- Text über der Suchleiste -->
    <div class="mb-5">
        <a href="{{ route('profileEdit') }}" class="inline-block text-lg bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Profileinstellungen
        </a>
    </div>
    <div class="mb-10">
    <!-- Logout Button -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-lg text-gray-800 bg-transparent hover:underline">Logout</button>
    </form>
</div>


<div class="mb-5">
    <p class="text-lg">Meine Anzeigen (zahl)</p>
</div>

    <!-- Suchleiste -->
    <div class="w-full flex justify-center">
        <input type="text" placeholder=" Suche..." class="form-control w-full p-5 h-12 text-xl mb-20">
    </div>
</div>

<!-- Navigationsleiste -->
<nav class="bg-gray-800 p-4 text-white fixed inset-x-0 bottom-0 flex justify-around">
    <a href="#" class="iconMessage"></a>
    <a href="#" class="iconAddAd"></a>
    <a href="#" class="iconProfile"></a>
</nav>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
