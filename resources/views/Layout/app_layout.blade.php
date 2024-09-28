<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - SMIJ Jose J Ariza</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div>
    <h1>Soy la app</h1>

    @yield('content')
</div>

@yield('scripts')
</body>
</html>
