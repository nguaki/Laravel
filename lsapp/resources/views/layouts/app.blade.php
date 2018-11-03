<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--Caused this error message:
        ...page... was loaded over HTTPS, but requested an insecure stylesheet 'http...
        -->
        <!--<link rel="stylesheet" href="{{asset('css/app.css')}}">-->
        <link rel="stylesheet" href="{{secure_asset('css/app.css')}}">
        <!--Data coming from .env APP_NAME -->
        <title>{{config('app.name', 'LSAPP')}}</title>

    </head>
    <body>
        @include('inc/navbar');
        <div class="container">
            @include('inc/messages');
            @yield('content')
        </div>
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
        </script>
    </body>
</html>