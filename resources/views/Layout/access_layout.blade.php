<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - SMIJ Jose J Ariza</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="contenedor-acceso vh-100 container d-flex align-items-center flex-column justify-content-center">
    <div class="row w-100 column-gap-5">
        <div class="col">
            @yield('form')
        </div>

        <div class="col-7">
            @yield('image')
        </div>
    </div>
</div>

@yield('scripts')
</body>
</html>
