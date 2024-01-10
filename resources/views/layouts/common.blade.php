<!doctype html>
<html lang="uk">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="favicon.ico">
        <title>@yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
        <link href="/css/loader.css" rel="stylesheet">
        <link href="/css/fontawesome.css" rel="stylesheet">
        <link href="/css/new_category.css" rel="stylesheet">
        <link href="/css/datatables.css" rel="stylesheet">
        <link href="/css/footer.css" rel="stylesheet">
    </head>
    <body>
        @include('layouts._parts.header')
        <div class="wrapper">
            @yield('content')
            <div class="backdrop" id="backdrop"></div>
        </div>
        @include('layouts._parts.footer')
        @include('layouts._parts.alerts')
        @include('layouts._parts.loader')
    </body>
    @include('layouts._parts.scripts')
</html>
