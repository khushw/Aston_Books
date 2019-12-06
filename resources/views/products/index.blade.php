@extends('layouts.app')

@section ('content')

<h1>Products</h1>

@if(count($products)>0)
    @foreach($products as $product)
        <div class="list-group-item">
            <h3><a href="/products/{{$product->id}}">{{$product->title}}</a></h3>
            <small> Price of the product {{$product->price}}</small>
        </div>
    @endforeach
    {{$products->links()}} <!-- displays the page number links for after x number of products appear) -->
@else 
    <p>No Post found</p>
@endif

@endsection