@extends('layouts.app')

@section ('content')

<h1>Edit Product</h1>
    {{-- {!! Form::open(['action' => ['ProductController@update',$product->id],'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title',$product->title,['class' => 'form-control','placeholder'=>'Title'] )}}
            
            {{Form::label('price','Price')}}
            {{Form::number('price',$product->price,['class' => 'form-control','placeholder'=>'Price'] )}}

            {{-- {{Form::label('condition','Condition')}}
            {{Form::select('condition', $condition, null, ['placeholder'=>'Please select from list'] )}}
             --}}
            {{-- {{Form::hidden('_method','PUT')}}
            {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
    </div>
    {!! Form::close() !!} --}}

    <div id="wrapper">
        <div id="editproduct" class="container">
            <h3>Update Books</h3>
        {{-- we use a hidden PUT method to tell browser its a PUT not a POST
            action redirects the user to the product page they edited --}}
        <form method="POST" action="/products/{{$product->id}}">
                @csrf
                @method('PUT')
                
                {{-- name of the book --}}
                {{-- label is the label for input area --}}
                <div class="field">
                    <label class="label" for="title">Book Name</label>
                    
                    <div class="control">
                    <input class="input" type="text" name="title" id="title" value="{{$product->title}}"> 
                    </div>
                
                </div>    

                {{--  price field --}}
                <div class="field">
                    <label class="label" for="price">Price</label>
                    
                    <div class="control">
                    <input class="input" type="number" name="price" id="price" value="{{$product->price}}"> 
                    </div>
                
                </div>
                    
                {{-- field for description of the book --}}
                <div class="field">
                    <label class="label" for="description">Book Description</label>
                    
                    <div class="control">
                    <textarea class="textarea" name="description" id="description">{{$product->description}}</textarea> 
                    </div>
                
                </div>

                {{-- author of the book --}}
                <div class="field">
                    <label class="label" for="author">Book Author</label>
                    
                    <div class="control">
                    <input class="input" type="text" name="author" id="author" value="{{$product->author}}"> 
                    </div>
                
                </div>

                {{-- publisher of the book --}}
                <div class="field">
                    <label class="label" for="publisher">Book Publisher</label>
                    
                    <div class="control">
                    <input class="input" type="text" name="publisher" id="publisher" value="{{$product->book_publisher}}"> 
                    </div>
                
                </div>

                {{-- book weight --}}
                <div class="field">
                    <label class="label" for="weight">Book Weight</label>
                    
                    <div class="control">
                    <input class="input" type="number" name="weight" id="weight" placeholder='Enter weight in KG' value="{{$product->weight}}"> 
                    </div>
                
                </div>
                
                {{-- book pages --}}
                <div class="field">
                    <label class="label" for="pages">Number of Pages</label>
                    
                    <div class="control">
                    <input class="input" type="number" name="pages" id="pages" placeholder='Enter total number of pages' value="{{$product->pages}}"> 
                    </div>
                
                </div>

                 {{-- book quantity --}}
                 <div class="field">
                    <label class="label" for="quantity">Number of Books</label>
                    
                    <div class="control">
                    <input class="input" type="number" name="quantity" id="quantity" placeholder='Enter amount of above books you want to sell' value="{{$product->quantity}}"> 
                    </div>
                
                </div>

                {{-- published at date --}}
                <div class="field">
                    <label class="label" for="published_date">Book Publish Date</label>

                <div class="control">
                <input class="input" type="date" name= "published_date" placeholder="enter year the book was published at" value="{{$product->published_date}}">
                </div>
                
                {{-- select different conditions of the book --}}
                <label class="label">Select Condition</label>
                <div class="form-group">
                    {{-- select allows me to create a dropdown --}}
                    {{-- option allows --}}
                <select name="conditionselect" id="condition" class="form-control input-lg dynamic" data-dependent="labSubCat">
                <option value="{{$conditionid}}">{{$conditionname}}</option>
                        @foreach($conditions as $co)
                            <option value="{{$co->id}}">{{$co->name}}</option>
                        @endforeach
                    </select>
                </div>   
                
                {{-- select different categories of the book --}}
                <label class="label">Select Category</label>
                <div class="form-group">
                    {{-- select allows me to create a dropdown --}}
                    {{-- option allows --}}
                    <select name="categoryselect" id="categories" class="form-control input-lg dynamic" data-dependent="labSubCat">
                    <option value="{{$categoriesid}}">{{$categoriesname}}</option>
                        @foreach($categories as $ca)
                            <option value="{{$ca->id}}">{{$ca->name}}</option>
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