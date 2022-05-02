<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>Регистрация</h1>

<form method="post" action="{{route('register.post')}}">
    @csrf

    <div>
        <label>
            Name
        </label>
        <input type="text" name="name" value="{{old('name')}}">
        @error('name')
        <div class="alert">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div>
        <label>
            E-mail
        </label>
        <input type="text" name="email" value="{{old('email')}}">
        @error('email')
        <div class="alert">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div>
        <label>Password</label>
        <input name="password" value="{{old('password')}}">
        @error('password')
        <div>{{$message}}</div>
        @enderror
    </div>
    <div>
        <input type="submit">
    </div>
</form>
</body>
</html>
