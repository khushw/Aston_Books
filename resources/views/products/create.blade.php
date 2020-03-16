@can('list-edit-products')

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
            {{-- added enctype for the user to upload images --}}
            <form method="POST" action="/products" id="create_products_form" enctype="multipart/form-data">
                @csrf
                
                {{-- name of the book --}}
                {{-- label is the label for input area --}}
                <div class="field">
                    <label class="label" for="title">Book Name</label>
                    
                    <div class="control">
                        <input class="input" type="text" name="title" id="title"> 
                    </div>
                
                </div>    

                {{--  price field --}}
                <div class="field">
                    <label class="label" for="price">Price</label>
                    
                    <div class="control">
                        <input class="input" type="number" name="price" id="price"> 
                    </div>
                
                </div>
                    
                {{-- field for description of the book --}}
                <div class="field">
                    <label class="label" for="description">Book Description</label>
                    
                    <div class="control">
                        <textarea class="textarea" name="description" id="description"></textarea> 
                    </div>
                
                </div>

                {{-- author of the book --}}
                <div class="field">
                    <label class="label" for="author">Book Author</label>
                    
                    <div class="control">
                        <input class="input" type="text" name="author" id="author"> 
                    </div>
                
                </div>

                {{-- publisher of the book --}}
                <div class="field">
                    <label class="label" for="publisher">Book Publisher</label>
                    
                    <div class="control">
                        <input class="input" type="text" name="publisher" id="publisher"> 
                    </div>
                
                </div>

                {{-- this is for the ISBN number --}}
                <div class="field">
                    <label class="label" for="ISBN_NO">ISBN Number</label>
                    
                    <div class="control">
                        <input class="input" type="text" name="ISBN_NO" id="ISBN_NO"> 
                    </div>
                
                </div>   

                {{-- book weight --}}
                <div class="field">
                    <label class="label" for="weight">Book Weight</label>
                    
                    <div class="control">
                        <input class="input" type="number" name="weight" id="weight" placeholder='Enter weight in KG'> 
                    </div>
                
                </div>
                
                {{-- book pages --}}
                <div class="field">
                    <label class="label" for="pages">Number of Pages</label>
                    
                    <div class="control">
                        <input class="input" type="number" name="pages" id="pages" placeholder='Enter total number of pages'> 
                    </div>
                
                </div>

                 {{-- book quantity --}}
                 <div class="field">
                    <label class="label" for="quantity">Number of Books</label>
                    
                    <div class="control">
                        <input class="input" type="number" name="quantity" id="quantity" placeholder='Enter amount of above books you want to sell'> 
                    </div>
                
                </div>

                {{-- published at date --}}
                <div class="field">
                    <label class="label" for="published_date">Book Publish Date</label>

                <div class="control">
                    <input class="input" type="date" name= "published_date" placeholder="enter year the book was published at">
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

                {{-- select different categories of the book
                <label class="label">Select Category</label>
                <div class="form-group">
                    {{-- select allows me to create a dropdown --}}
                    {{-- option allows --}}
                     {{-- <select name="categoryselect" id="categories" class="form-control input-lg dynamic" data-dependent="labSubCat">
                    <option value="{{$categories}}">Select Category</option>
                        @foreach($categories as $ca)
                            <option value="{{$ca->id}}">{{$ca->name}}</option>
                        @endforeach
                    </select>
                </div>  --}}
                
                <label class="label">Select Category</label>
                <div class="form-group">
                    {{-- select allows me to create a dropdown --}}
                    {{-- option allows to display individual values from the dropdown --}}
                     <select name="categories1[]" id="categories" class="form-control input-lg dynamic" data-dependent="labSubCat" multiple>
                    <option value="{{$categories}}" disabled selected>Select Category</option>
                        @foreach($categories as $ca)
                            <option value="{{$ca->id}}">{{$ca->name}}</option>
                        @endforeach
                    </select>
                </div> 

                {{-- for user to upload multiple images --}}
                <div class="form-group">
                    <label class="label" for="imagecollection"> Product Thumbnail </label>
                    <input type="file" class="form-control" name="thumbnail" required>
                </div>

                <div class="form-group">
                    <label class="label" for="imagecollection"> Product Images </label>
                    <input type="file" class="form-control" name="images[]" multiple required>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link" type="submit" id="disable-button">Submit</button>
                </div>

                </div>                                
            </form>
        </div>
    </div>
@endsection

{{-- to disable the submit button once if the user click on it  --}}
@section('extra-js')
        <script type="text/javascript">
                $(document).ready(function () {
                $("#create_products_form").submit(function (e) {
                    $("#disable-button").attr("disabled", true);
                    return true;
                });
            });
        </script>
@endsection
@endcan