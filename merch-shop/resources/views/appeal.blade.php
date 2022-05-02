<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
@if ($success)
    <p>Обращение успешно отправлено</p>
@endif

<form method="post" action="{{route('appeal.send')}}">
    @csrf
    <div>
        <label>Имя</label>
        <input type="text" name="name" value="{{old('name')}}"/>
        @error('name')
        <div>{{$message}}</div>
        @enderror
    </div>
    <div>
        <label>Почта</label>
        <input type="text" name="phone" value="{{old('phone')}}"/>
        @error('$phone')
        <div>{{$message}}</div>
        @enderror
    </div>
    <div>
        <label>Телефон</label>
        <input type="text" name="email" value="{{old('email')}}"/>
        @error('$email')
        <div>{{$message}}</div>
        @enderror
    </div>
    <div>
        <label>Message</label>
        <textarea name="message" value="{{old('message')}}"></textarea>
        @error('$message')
        <div>{{$message}}</div>
        @enderror
    </div>
    <div>
        <input type="submit"/>
    </div>
</form>
</body>
</html>
