@extends('layouts.app')
@section('index')
        <div class="jumbotron text-center">
                <h1>{{$title}}</h1>
                <p>This is a dynamic and friendly website for buying and selling books</p>
                <p><a class="btn btn-primary btn-lg" href="login" role="button">Login</a> <a class="btn btn-primary btn-lg" href="register" role="button">Register</a></p>
        </div>  
                {{-- view all the featured products --}}
                @forelse ($products as $product)
                        <div class="list-group-item">
                                <h3><a href="/products/{{$product->id}}">{{$product->title}}</a></h3>
                                <small> Price of the product {{$product->price}}</small>
                         </div>
                         
                @empty
                        <div><h3> No items found </h3></div>
                @endforelse 
                
                <button><a href="{{ route ("products.index")}}">View all Books</a></button>
@endsection