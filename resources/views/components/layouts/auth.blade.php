<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}
    <title>my website</title>
</head>


<body class="h-full">
    <div class="min-h-full">
        @include('partials.navbar')

        <main>
            <div class="mx-auto max-w-7xl px-4 py-2 sm:px-6 lg:px-8 ">
                {{ $slot }}
            </div>
        </main>
    </div>

</body>

</html>



<nav>
