<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landingpage</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200 flex flex-col h-screen">

<div class="flex flex-col items-center px-4 w-full" style="padding-top: 5%;">
    <!-- Slogan Bereich -->
    <div class="text-center mb-60">
        <h1 class="text-3xl font-bold"> Titel </h1>
    </div>

    <!-- Text über der Suchleiste  -->
    <div class="mb-5">
        <p class="text-lg">Slogan Platzhalter</p>
    </div>

    <!-- Suchleiste -->
    <div class="w-full flex justify-center">
        <input type="text" placeholder=" Suche..." class="form-control w-full p-5 h-12 text-xl mb-20">
    </div>
</div>

<!-- Navigationsleiste -->
<x-navbar />

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
