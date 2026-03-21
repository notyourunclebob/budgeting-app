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

<body class="bg-gray-100">
    <header class="bg-gray-900 text-white mb-12" id="top">
        <nav class="container mx-auto px-4 py-4 flex gap-4">
            <a class="text-lg font-medium">Budgets</a>
            <a class="text-lg font-medium">Expenses</a>
        </nav>
    </header>

    <div class="container mx-auto px-4">
        {{ $slot }}
    </div>
</body>

</html>
