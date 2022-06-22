<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categories</title>
</head>
<body>
    Catalog
    @include('catalog.catalog_list', ['categories' => $categories])

    @foreach($products as $product)
        <article>
            <a href="{{route('product',$product->slug)}}">
                <h3>{{$product->name}}</h3>
            </a>
            <p>{{$product->price}}</p>
        </article>
    @endforeach
    {{$products->links()}}
    <div>
        <h2>Filters</h2>
        <form method="get">
            <div>
                <label for="search_query">Search</label>
                <input type="text" name="search_query" id="search_query" value="{{ request('search_query') }}">
            </div>
            <div>
                <label for="sort_mode">Sort mode</label>
                <select name="sort_mode" id="sort_mode">
                    <option
                        value="price_asc"
                        {{ \App\Enums\ProductSortType::keyToValue(request('sort_mode')) === \App\Enums\ProductSortType::PRICE_ASC ? 'selected' : '' }}>
                        Price asc
                    </option>
                    <option
                        value="price_desc"
                        {{\App\Enums\ProductSortType::keyToValue(request('sort_mode')) === \App\Enums\ProductSortType::PRICE_DESC ? 'selected' : '' }}}>
                        Price desc
                    </option>
                </select>
            </div>
            <div>
                @foreach($filters as $filter)
                    <div>
                        <h4>{{ $filter->name }}</h4>
                        @foreach($filter->options as $option)
                            <label>
                                <input type="checkbox" value="{{ $option->value }}" name="filters[{{ $filter->key }}][]"
                                    {{ $option->isSelected ? 'checked' : '' }}>
                                {{ $option->value }} ({{ $option->productCount }})
                            </label>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <button>Submit</button>
        </form>
    </div>

    <div>
        @foreach($products as $i => $product)
            <img src="http://picsum.photos/id/{{$i *10}}/100"/>
            <a href="{{route('product',$product->slug)}}">
                <h3>{{$product->name}}</h3>
            </a>
            <p>{{number_format(round($product->price,2),2,',', ' ')}}$</p>
        @endforeach
    </div>
    <div>
        @foreach($filters as $filter)
            <h4>{{$filter->name}}</h4>
            @foreach($filter->options as $option)
                <div>
                    <label>
                        <input type="checkbox" value="{{$option->value}}" name="filters[{{$filter->key}}][]" {{$option->isSelected ? 'checked': ''}}>
                        {{$option->value}}
                    </label>
                </div>
            @endforeach
        @endforeach
    </div>
</body>
</html>
