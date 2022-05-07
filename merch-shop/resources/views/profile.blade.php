<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
</head>
<body>
<h1>Profile</h1>
<div>
    <h4>App:</h4>
    <label>
        <b> Last login date: {{ $user['app_logged_in_at'] ?? 'Never' }}</b>
        <b> Registration date: {{ $user['app_registered_at'] ?? 'Never' }}</b>
    </label>
    <h3>OAuth info:</h3>
    <h4>Github:</h4>
    <label>
        <b> Last login date: {{ $user['github_logged_in_at'] ?? 'Never' }}</b>
        <b> Registration date: {{ $user['github_registered_at'] ?? 'Never' }}</b>
    </label>

</div>
<p>{{ $user['name'] }}</p>
<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>
</body>
</html>
