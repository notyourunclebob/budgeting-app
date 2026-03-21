<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body class="bg-gray-100 text-shadowgray">
    <header class="bg-granite text-ash" id="top">
        <nav class="container mx-auto px-4 py-4 flex gap-4">
            <a class="text-md font-medium">Budgets</a>
            <a class="text-md font-medium">Expenses</a>
        </nav>
    </header>
    <div class="bg-sage text-white text-xl font-bold">
        <h1 class="container mx-auto px-4 py-4">{{ $title }}</h1>
    </div>

    <div class="container mx-auto px-4">
        {{ $slot }}
    </div>
</body>

</html>
