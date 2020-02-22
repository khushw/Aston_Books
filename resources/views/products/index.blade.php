@extends('layouts.app')

@section ('content')

<h1>Products</h1>

{{-- to display the cateogries filter  --}}
<div class="products-section container">
    <div class="sidebar">
        <h3> By Category </h3>
        <ul>
            @foreach ($categories as $category)
                {{-- use query string to show the index page, for the category that is selected by the user --}}
                {{-- if cat the user on is the one he selected it will get highlighted, added css in the app.scss file for it aswell--}}
                <li class="{{ request()->category == $category->slug ? 'active' : ""}}"> <a href=" {{ route("products.index", ["category" => $category->name]) }}">{{$category->name}}</a><li>
            @endforeach
        </ul>
    </div>
    <div>
        {{-- displays the cateogry name the user has selected --}}
        <div class="products-header">
            <h1 class="stylish-heading"> {{$categoryName}} <h1>    
        </div>
        {{-- on every cateogry the user clicks on, they will have option to filter by price low to high and vice versa --}}
        <div>
            <strong>Price </strong>
            {{-- as we are not in the a loop we have to get the cateogry by the request() --}}
            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "low_high"]) }}"> Low to High</a>
            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "high_low"]) }}"> High to Low</a>
        </div>
    </div>
</div>
    {{-- use te forelse directive to handle if there are no products --}}
    @forelse ($products as $product)
  
    <div class="list-group-item">
        <h3><a href="/products/{{$product->id}}">{{$product->title}}</a></h3>
        <small> Price of the product {{$product->price}}</small>
    </div>
    @empty
        <div><h3> No items found </h3></div>
    @endforelse
        {{-- {{$products->links()}} --}}
        {{-- this appends the links if there is pre existing query string e.g. the price --}}
        {{ $products->appends(request()->input())->links() }}
@endsection