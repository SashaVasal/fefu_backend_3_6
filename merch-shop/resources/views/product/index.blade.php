<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$product->name}}</title>
</head>
<body>
    <h1>{{$product->name}}</h1>
    <h1>{{$product->price}}</h1>
    <h1>{{$product->description}}</h1>


    @foreach($product->sortedAttributeValues as $attributeValue)
        <p>{{ $attributeValue->productAttribute->name  }}</p>
        <p>{{ $attributeValue->value }}</p>
    @endforeach

</body>
</html>
