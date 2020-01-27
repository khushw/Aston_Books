@extends('layouts.app')

@section ('content')

{{-- <h1>Create Product</h1>
    {!! Form::open(['action' => 'ProductController@store','method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class' => 'form-control','placeholder'=>'Title'] )}}
            
            {{Form::label('price','Price')}}
            {{Form::number('price','',['class' => 'form-control','placeholder'=>'Price'] )}}

            {{Form::label('condition','Condition')}}
            {{Form::select('condition', $conditionss, null, ['placeholder'=>'Please select from list'] )}}
            
            {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!} --}}


    <div id="wrapper">
        <div id="createproduct" class="container">
            <h3>Upload Books</h3>
            <form method="POST" action="/products">
                @csrf
                
                {{-- displays the name of the book --}}
                <div class="field">
                    <label class="label" for="title">Book Name</label>
                    <div class="control">
                        <input class="input" type="text" name="title" id="title"> 
                    </div>
                </div>    
                
                {{-- displays the price field --}}
                <div class="field">
                    {{-- label is the label for input area --}}
                    <label class="label" for="price">Price</label>
                    <div class="control">
                        <input class="input" type="number" name="price" id="price"> 
                    </div>
                </div>

                {{-- select different conditions of the book --}}
                <label class="label">Select Condition</label>
                <div class="form-group">
                    {{-- select allows me to create a dropdown --}}
                    {{-- option allows --}}
                    <select name="conditionselect" id="condition" class="form-control input-lg dynamic" data-dependent="labSubCat">
                    <option value="{{$conditions}}">Select Condition</option>
                        @foreach($conditions as $co)
                            <option value="{{$co->name}}">{{$co->name}}</option>
                        @endforeach
                    </select>
                </div>   
                
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link" type="submit">Submit</button>
                </div>

                </div>                                
            </form>
        </div>
    </div>
@endsection