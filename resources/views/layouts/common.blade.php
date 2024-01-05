<!doctype html>
<html lang="uk">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="favicon.ico">
        <title>@yield('title')Login</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
    </head>
    <body>
        @include('layouts._parts.header')
        <div class="wrapper">
            @yield('content')
        </div>
        @include('layouts._parts.footer')
        @include('layouts._parts.alerts')
    </body>
    @include('layouts._parts.scripts')
</html>