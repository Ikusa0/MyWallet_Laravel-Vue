<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MyWallet')</title>
</head>

<body>
    <div id='app'>
        @yield('content')

        @vite('resources/js/app.js')
    </div>
</body>

</html>
