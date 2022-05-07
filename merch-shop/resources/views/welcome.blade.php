<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <a href="{{route('login')}}">Login</a>
    <a href="{{route('register')}}">register</a>
    </body>
</html>
