
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
<small>Book Category: {{ implode(', ', $product->categories()->get()->pluck('name')->toArray()) }}  </small>
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
<form action="{{route('carts.store')}}" method="POST">
     {{ csrf_field() }}
    <input type="hidden" name="id" value ="{{ $product->id}}">
    <input type="hidden" name="title" value ="{{ $product->title}}">
    <input type="hidden" name="price" value ="{{ $product->price}}">
     <button type="submit" class="button button-plain"> Add to Cart </button>
</form>
{{-- <a href='/products/{{ $product->id}}/edit' class='button'> Add to Cart </a> --}}


<a href='/products/{{ $product->id}}/edit' class='btn btn-default'> Edit Listing </a>

{{-- calling the destroy method in contrller and then remove the listing from the application --}}
{!!Form::open(['action'=> ['ProductController@destroy', $product->id], 'method' => 'POST' , 'class'=> 'pull-right'])!!}
 {{-- //includes the hidden spoofing method and the submit button --}}
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
{!!Form::close() !!}
@endcan
@endsection