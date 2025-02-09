<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-50 ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <livewire:opportunities />
    </div>

     @livewireScripts
    </body>
</html>
