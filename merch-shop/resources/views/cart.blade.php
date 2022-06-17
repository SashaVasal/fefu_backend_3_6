<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>
</head>
<body>
<table>
    @foreach($cart['items'] as $cartItem)
        <tr>
            <td><a href="{{ route('product', ['slug' => $cartItem['product']['slug']]) }}">{{ $cartItem['product']['name'] }}</a></td>
            <td>{{ $cartItem['price_item'] }} rub.</td>
            <td>{{ $cartItem['quantity'] }}</td>
            <td>{{ $cartItem['price_total'] }} rub.</td>
        </tr>
    @endforeach
</table>
<b>Total: {{ $cart['price_total'] }} rub.</b>
</body>
</html>
