@extends('layouts.app')

@section ('content')

<h1>Create Product</h1>
    {!! Form::open(['action' => 'ProductController@store','method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class' => 'form-control','placeholder'=>'Title'] )}}
            
            {{Form::label('price','Price')}}
            {{Form::number('price','',['class' => 'form-control','placeholder'=>'Price'] )}}

            {{Form::label('condition','Condition')}}
            {{Form::select('condition', $condition, null, ['placeholder'=>'Please select from list'] )}}
            
            {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}
@endsection