<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>Profile</h1>
<h1>{{$user['name']}}</h1>
<h1>Дата входа {{$user['logged_in_at']}} </h1>
<h1>Дата регистрации {{$user['registered_at']}} </h1>

<h1>Github</h1>
<h1>Дата входа {{$user['github_logged_in_at']}} </h1>
<h1>Дата регистрации {{$user['github_registered_at']}} </h1>

<h1>VK</h1>
<h1>Дата входа {{$user['vkontakte_logged_in_at']}} </h1>
<h1>Дата регистрации {{$user['vkontakte_registered_at']}} </h1>

<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>
</body>
</html>
