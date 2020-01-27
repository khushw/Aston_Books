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
<hr>
<small>Condition: {{$product->condition_id}}</small>
<hr>

{{-- button to navigate user to the edit page  --}}
<a href='/products/{{ $product->id}}/edit' class='btn btn-default'> Edit Listing </a>



{{-- calling the destroy method in contrller and then remove the listing from the application --}}
{!!Form::open(['action'=> ['ProductController@destroy', $product->id], 'method' => 'POST' , 'class'=> 'pull-right'])!!}
 {{-- //includes the hidden spoofing method and the submit button --}}
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
{!!Form::close() !!}
@endsection