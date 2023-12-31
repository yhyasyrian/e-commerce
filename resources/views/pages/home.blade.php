<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ \App\Http\Controllers\Site\VarController::getSitting('title') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    @vite(['resources/scss/style.scss', 'resources/ts/app.ts'])
</head>

<body class="font-[Cairo]">

    @include('layouts.header')
    <main class="relative" id="app">
        @yield('app')
    </main>
    @include('layouts.footer')
</body>

</html>
