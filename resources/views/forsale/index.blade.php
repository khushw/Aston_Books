@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Items for sale</div>

                <div class="card-body">
                    {{-- this table came from https://getbootstrap.com/docs/4.3/content/tables/ --}}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Product ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            {{-- for each loop searchs the table and find all orders came in for this persons listing  --}}
                            @foreach ($products as $product)
                            {{-- @if ($listings->shipped == 0 ) --}}
                                {{-- if the logged on user id matches the id on the order then display all their listings --}}
                                    @if (Auth::id() == $product->user_id)
                                            <tr>
                                                <th scope="row"> {{$product->id}}</th>
                                                <td>  {{$product->title}}</td>
                                                <td> {{$product->quantity}}</td>
                                                <td>
                                                    <a href='/products/{{ $product->id}}/edit'><button type="button" class="btn btn-primary float-left">Edit Product</button></a>
                                                    {!!Form::open(['action'=> ['ProductController@destroy', $product->id], 'method' => 'POST' , 'class'=> 'pull-left'])!!}
                                                        {{-- //includes the hidden spoofing method and the submit button --}}
                                                    {{Form::hidden('_method','DELETE')}}
                                                    {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                                                {!!Form::close() !!}
                                                </td>
                                            </tr>  
                                    @endif
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection