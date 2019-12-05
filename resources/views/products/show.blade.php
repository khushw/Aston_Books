@extends('layouts.app')

@section ('content')
<a href="/products" class="btn btn-default"> Go Back</a>
<h1>{{$product->title}}</h1>
<div>
    {{$product->description}}
<div>
<hr>
<small>Price: {{$product->price}}</small>
@endsection