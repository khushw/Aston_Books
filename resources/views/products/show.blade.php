
@extends('layouts.app')

@section ('content')

{{-- back button to go back on the all products --}}
<a href="/products" class="btn btn-default"> Go Back</a>

{{-- product details/all the fields --}}
<h1>{{$product->title}}</h1>
<div>
    {{$product->description}}
<div>
<hr>
<small>Book Price: {{$currency}} {{$product->price}}</small>
<hr>
<hr>
<small>Book Condition: {{$conditions}}</small>
<hr>
<hr>
<small>Book Category: {{$categories}}</small>
<hr>
<hr>
<small>Book Description: {{$product->description}}</small>
<hr>
<hr>
<small>Book Author: {{$product->author}}</small>
<hr>
<hr>
<small>Book Publisher: {{$product->book_publisher}}</small>
<hr>
<hr>
<small>Book Weight: {{$product->weight}}{{$kilosymbol}}</small>
<hr>
<hr>
<small>Book Pages: {{$product->pages}}</small>
<hr>
<hr>
<small>Book Quantity: {{$product->quantity}}</small>
<hr>
<hr>
<small>Published Date: {{$product->published_date}}</small>
<hr>
<hr>
<small>Seller Name: {{$username}}</small>
<hr>

@can('list-edit-products')
{{-- button to navigate user to the edit page  --}}
<a href='/products/{{ $product->id}}/edit' class='btn btn-default'> Edit Listing </a>



{{-- calling the destroy method in contrller and then remove the listing from the application --}}
{!!Form::open(['action'=> ['ProductController@destroy', $product->id], 'method' => 'POST' , 'class'=> 'pull-right'])!!}
 {{-- //includes the hidden spoofing method and the submit button --}}
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
{!!Form::close() !!}
@endcan
@endsection