@extends('layouts.app')

@section ('content')
<a href="/products" class="btn btn-default"> Go Back</a>
<h1>{{$product->title}}</h1>
<div>
    {{$product->description}}
<div>
<hr>
<small>Price: {{$product->price}}</small>
<hr>
<a href='/products/{{ $product->id}}/edit' class='btn btn-default'> Edit Listing </a>

{!!Form::open(['action'=> ['ProductController@destroy', $product->id], 'method' => 'POST' , 'class'=> 'pull-right'])!!}
 {{-- //includes the hidden spoofing method and the submit button --}}
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
{!!Form::close() !!}
@endsection