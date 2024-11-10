<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/js/app.js')
    @vite('resources/css/app.css')


    @stack('styles')

    <link rel="stylesheet" href="{{ asset('css/template/alerts.css') }}">

    <title>@yield('title') - {{ config('app.name') }}</title>
</head>
<body>

<div class="relative">

    <div>
        {{--    NavBar    --}}
        @include('components.layout.clientNavBar')

    </div>

    <main class="py-10">
        <div class="px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>
</div>


@stack('scripts')

</body>
</html>
