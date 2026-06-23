<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        *{
            box-sizing: border-box;
        }
        html{
            scrollbar-width: thin;
            scrollbar-color: rgba(128, 128, 128, 0.604) white
        }
        body{
            background-image: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);
        }
        main{
            min-height: 80vh !important;
        }
    </style>

    @yield('head')

    <title>Kabouwa - @yield('title')</title>
</head>

<body>
    {{-- Method include --}}
    {{-- @include('components.header') --}}
    {{-- Components Method --}}
    <x-header/>

    <main class="container py-4">

        <p class="display-3 my-0">@yield('heading') : </p>
        <p> <a href="{{ $_SERVER['HTTP_REFERER'] ?? route("posts.index")}}" class="text-muted text-decoration-none"><i class="bi bi-arrow-left-circle"></i> Go back</a> </p>

        {{-- Main Content --}}
        @yield('content')

    </main>

    {{-- @include('components.footer') --}}
    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
    @yield('scripts')
</body>
</html>