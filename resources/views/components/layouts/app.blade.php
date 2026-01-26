<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- @vite('resources/css/app.css')
    @vite(['resources/js/app.js']) --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>my website</title>
</head>

<body class="h-full">
    <div class="min-h-full">
        @include('partials.navbar')

        <header class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
                {{-- @auth
                    @php
                        $department_id = auth()->user()->employee->department->id ?? null;
                    @endphp
                    @if ($department_id === 2)
                        <x-button href="/employees/create">add employee</x-button>
                    @elseif($department_id === 3)
                        <x-button href="/customers/create">add customer</x-button>
                    @elseif($department_id === 4)
                        <x-button href="/stores/create">add store</x-button>
                    @elseif($department_id === 5)
                        <x-button href="/warehouses/create">add warehouse</x-button>
                    @elseif($department_id === 6)
                        <x-button href="/products/create">add product</x-button>
                    @endif
                @endauth --}}
            </div>



        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

</body>

</html>



<nav>
