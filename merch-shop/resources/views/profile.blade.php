<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>Profile</h1>
<form action="{{route('logout')}}" method="post">
    <button type="submit">logout</button>
</form>
</body>
</html>
