
{{-- saved links --}}

for the shopping cart
https://bootsnipp.com/snippets/K012l
https://fontawesome.com/v4.7.0/icon/shopping-cart - used this for the icons

for the products index page, used bootstrap album webpage

for the checkout page, used bootstrap checkout example 
https://getbootstrap.com/docs/4.0/examples/checkout/



{{-- end of saved links --}}
{{-- this WAS the FILTERS SECTION --}}
{{-- to display the cateogries filter  --}}
<div class="products-section container">
    <div class="sidebar">
        <h3> By Category </h3>
        <ul>
            @foreach ($categories as $category)
                {{-- use query string to show the index page, for the category that is selected by the user --}}
                {{-- if cat the user on is the one he selected it will get highlighted, added css in the app.scss file for it aswell--}}
                <li class="{{ request()->category == $category->slug ? 'active' : ""}}"> <a href=" {{ route("products.index", ["category" => $category->name]) }}">{{$category->name}}</a><li>
            @endforeach
        </ul>
    </div>
    <div>
        {{-- displays the cateogry name the user has selected --}}
        <div class="products-header">
            <h1 class="stylish-heading"> {{$categoryName}} <h1>
        </div>
        {{-- on every cateogry the user clicks on, they will have option to filter by price low to high and vice versa --}}
        <div>
            <strong>Filters</strong>
            {{-- as we are not in the a loop we have to get the cateogry by the request() --}}
            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "low_high"]) }}"> Low to High</a>
            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "high_low"]) }}"> High to Low</a>
            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "date_listed_earliest"]) }}"> Published Earliest</a>
            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "date_listed_longest"]) }}"> Published Longest</a>

        </div>
    </div>
</div>


{{-- this was deleted from the shopping cart index page --}}

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
            
         {{-- Potential to put in Head Tage --}}
    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    {{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
    {{-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
    <!------ Include the above in your HEAD tag ---------->
    
    {{-- <script src="https://use.fontawesome.com/c560c025cf.js"></script> --}}
    {{-- End of Head tag stuff --}}

        
        <div class="cart-table">
            @foreach (Cart::content() as $item)
            <div class="cart-table-row">
                <div class="cart-table-row-left">
                    <a> Image will be here, refence from the image</a>
                    <div class="cart-item-details"> 
                        <div class="cart-table-item"><a href="/products/{{$item->id}}">Book Title: {{$item->model->title}}</a></div>
                        <div class="cart-table-description">Description: {{$item->model->description}} </div>
                        <div class="cart-table-price">Price: ${{$item->subtotal}} </div>
                        <div>  Quantity
                                <select class="quantity" data-id="{{$item->rowId}}" data-productQuantity="{{$item->model->quantity}}">
                                    @for ($i = 1; $i <= $item->model->quantity ; $i++)
                                        <option {{$item->qty == $i ? 'selected' : ''}}>{{$i}}</option>    
                                    @endfor
                                </select>
                        </div>
                    </div>
                </div>
                <div class="cart-table-row-right">
                    <div class="cart-item-actions"> 
                        
                        <form action="{{ route('carts.destroy', $item->rowId)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="cart-options">Remove </button>
                        </form> --}}
                        {{-- save for later form --}}
                    
                         <form action="{{ route('carts.switchToSaveForLater' , $item->rowId)}}" method="POST">
                            @csrf
                            <button type="submit" class="cart-options">Save for Later </button>
                    </form>
                        
                    </div>
                </div>
            </div>                
            @endforeach
        </div>
        <div  class="cart-totals-right">
            <div>
                SubTotal: <br>
                Tax: <br>                    
            </div>
            <div class="cart-totals-subtotal">
                Subtotal: £{{Cart::subtotal()}}<br>
                Tax: £{{Cart::tax()}}
            </div>
            <span class="cart-totals-total">Total: £{{Cart::total()}}</span>                
        </div> 
        <div class="cart-buttons">
            <a href="{{route("products.index")}}" class="button"> Continue Shopping </a>
            <a href="{{route("checkout.index")}}" class="button"> Proceed to Checkout</a>
        </div>
        
        {{-- when there are no items in cart --}}

<div class="saved-for-later cart-table">
    @foreach (Cart::instance('saveForLater')->content() as $item)
        
    
    <div class="cart-table-row">
        <div class="cart-table-row-left">
            <a href="#" class="cart-table-img"> Image will be here </a>
            <div class="cart-item-details">
                <div class="cart-table-item"> <a href="/products/{{$item->id}}"> Title:{{$item->model->title}} </a></div>
                <div class="cart-table-description"> Description:{{$item->model->description}} </div>
                <div class="cart-table-price"> Price:${{$item->model->price}} </div>
            </div>  
        </div>
        <div class="cart-table-row-right">
            <div class="cart-table-actions">
                
                <form action="{{ route('saveForLater.destroy', $item->rowId)}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="cart-options">Remove </button>
                </form>
            {{-- save for later form --}}
            
            <form action="{{ route('saveForLater.switchToCart' , $item->rowId)}}" method="POST">
                @csrf
                <button type="submit" class="cart-options"> Move to cart </button>
            </form>
            </div>
        </div>
    </div> 
    @endforeach
</div>

<h2>{{ Cart::instance('saveForLater')->count() }} item(s) Saved for Later </h2>



            {{-- <h3> No items in cart</h3>
            <a href="{{route("products.index")}}" class="button"> Continue Shopping </a> --}}

   {{-- <div class="spacer"></div>
            <a href="{{route("products.index")}}" class="button"> Continue Shopping </a>
            <div class="spacer"></div> --}}



{{-- checkout page redone  --}}
{{--  --}}

<div class="container">
    <h1 class="checkout-heading stylish-heading"> Checkout </h1>
    <div class="checkout-section">
        <div>
            <form action="{{route('checkout.store')}}" method="POST" id="payment-form">
                 {{ csrf_field() }}
                <h2> Shipping Details </h2>
                
                <div class="form-group">
                    <label for="email"> Email Address </label>
                    <input type="email"  class="form-control" id="email" name="email" value="{{$email}}">
                </div>

                <div class="form-group">
                    <label for="name"> Name </label>
                    <input type="text"  class="form-control" id="name" name="name" value="{{$name}}">
                </div>

                <div class="form-group">
                    <label for="address"> Address </label>
                    <input type="text"  class="form-control" id="address" name="address" value="{{ old ('address') }}">
                </div>

                <div class="half-form">
                    <label for="city"> City </label>
                    <input type="text"  class="form-control" id="city" name="city" value="{{ old ('city') }}">
                </div>
                
                <div class="form-form">
                    <label for="postcode"> Postcode </label>
                    <input type="text"  class="form-control" id="postcode" name="postcode" value="{{ old ('postcode') }}">
                </div>
                
                <div class="form-form">
                    <label for="phone"> Phone </label>
                    <input type="text"  class="form-control" id="phone" name="phone" value="{{ old ('phone') }}">
                </div>

                <div class="spacer"></div>

                <h2> Payment Details </h2>

                <div class="form-group">
                    <label for="name_on_card"> Name on Card </label>
                    <input type="text"  class="form-control" id="name_on_card" name="name_on_card" value="{{ old ('name_on_card') }}">
                </div>

                {{-- <div class="form-group">
                    <label for="address"> Address </label>
                    <input type="text"  class="form-control" id="address" name="address" value="{{ old ('address') }}">
                </div> --}}

                {{-- STRIPE payment method input fields for the user card details --}}
                {{-- <div class="form-group">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>
                
                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>  --}}

                {{-- <div class="form-group">
                    <label for="cc-number"> Credit Card Number </label>
                    <input type="text"  class="form-control" id="cc-number" name="cc-number" value="">
                </div> --}}

                {{-- start of half form  --}}
                {{-- <div class="half-form">
                   
                    <div class="form-group">
                        <label for="expiry"> Expiry </label>
                        <input type="text"  class="form-control" id="expiry" name="expiry" value="">
                    </div>

                    
                    <div class="form-group">
                        <label for="cvc"> CVC Code </label>
                        <input type="text"  class="form-control" id="cvc" name="cvc" value="">
                    </div>
                </div>  --}}
              

                <div class="spacer"></div>

                <button type="submit" id="disable-button" class="button-primary full-width"> Complete Purchase </button>

            </form>
        </div>

        <div class="checkout-table-container">
            <h2> Your Order</h2>
            <div class="checkout-table">
                @foreach (Cart::content() as $item)
                    <div class="checkout-table-row">
                        <div class="checkout-table-row-left">
                            <img src="#" alt="item" class="checkout-table-img">
                            <div class="checkout-item-details">
                                <div class="checkout-table-item"> Title:{{$item->model->title}} </div>
                                <div class="checkout-table-description">  Description:{{$item->model->description}} </div>
                                <div class="checkout-table-price"> Price:${{$item->model->price}} </div>      
                            </div>                                
                        </div>  
                        {{-- end of checkout table row left --}}
                        <div class="checkout-table-row-right">
                            <div class="checkout-table-quantity"> {{$item->qty}} </div>
                        </div>
                    </div>
                @endforeach

                <div class="checkout-table-row">
                    <div class="checkout-table-row-left">
                    
                    </div>
                </div>

                <div class="checkout-totals">
                    <div class="checkout-totals-left">
                        {{-- Discount Codes etc --}}
                    {{-- <span class="checkout-totals-total"> Discount Toatal<br></span> --}}
                    </div>
                </div>
                
                <div class="checkout-totals">
                    <div class="checkout-totals-right">
                       Subtotal  {{Cart::subtotal()}}<br>
                        Tax {{Cart::tax()}}<br>
                    <span class="checkout-totals-total"> Total {{Cart::total()}}<br></span>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


{{-- end of checkout redone --}}


{{-- deleted code in CREATE PRODUCTS PAGE --}}

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

{{-- end of CREATED PRODUCTS PAGE --}}


{{-- edit products page  --}}
<div id="wrapper">
    <div id="editproduct" class="container">
        <h3>Update Books</h3>
    {{-- we use a hidden PUT method to tell browser its a PUT not a POST
        action redirects the user to the product page they edited --}}

        {{-- display the image --}}
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/gallery/{{$product->thumbnail}}" alt="First slide">
                </div>
                <p hidden>{{$images = DB::table('photos')->where('product_id',$product->id)->get()}}
                    <p>
                        @foreach ( $images as $image)
                        <div class="carousel-item">
                            <img class="d-block w-100" src="/gallery/{{$image->path}}" alt="other slide">                        
                            <div class="carousel-caption d-none d-md-block">
                                <form action="{{ route('photos.destroy', $image->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger">remove</button>
                                </form>
                            </div> 
                        </div>
                        @endforeach
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
            </div>
        </div>
        <div>
            <form action="{{ route('photos.store', $product->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                @csrf
                <input class="input" type="text" name="productId" id="productId" value="{{$product->id}}" hidden> 
                {{-- Add & Update Gallery --}}
                <div class="form-group">
                    <label class="label" for="imagecollection"> Replace Product Thumbnail </label>
                    <input type="file" class="form-control" name="thumbnail" >
                </div>

                <div class="form-group">
                    <label class="label" for="imagecollection"> Replace Product Images </label>
                    <input type="file" class="form-control" name="images[]" multiple >
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link" type="submit">Update</button>
                    </div>
                </div> 
            </form>
        </div>


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
            
            {{-- for the isbn no --}}
            <div class="field">
                <label class="label" for="ISBN_NO">ISBN Number</label>
                
                <div class="control">
                <input class="input" type="text" name="ISBN_NO" id="ISBN_NO" value="{{$product->ISBN_NO}}"> 
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
                <option value="{{$conditionname}}">{{$conditionname}}</option>
                @foreach($conditions as $co)
                    <option value="{{$co->name}}">{{$co->name}}</option>
                @endforeach
            </select>
            </div>   
            
            {{-- select different categories of the book --}}
            {{-- <label class="label">Select Category</label>
            <div class="form-group">
                {{-- select allows me to create a dropdown --}}
                {{-- option allows --}}
                {{-- <select name="categoryselect" id="categories" class="form-control input-lg dynamic" data-dependent="labSubCat">
                <option value="{{$categoriesid}}">{{$categoriesname}}</option>
                    @foreach($categories as $ca)
                        <option value="{{$ca->id}}">{{$ca->name}}</option>
                    @endforeach
                </select>
            </div>  --}} 
            
            
            
            <label class="label">Select Category</label>
                <div class="form-group">    
                        @foreach ($categories as $cats)
                            <div class="form-check">
                                <input type="checkbox" name="categories1[]" value="{{ $cats->id }}"
                                {{-- if current user role has one of the roles in the roles table then the box should be checked --}}
                                @if($product->categories()->pluck('category_id')->contains($cats->id)) checked @endif>
                                <label> {{$cats->name}} </label>
                            </div>                            
                        @endforeach
                </div>  
            


            <div class="field is-grouped">
                <div class="control">
                    <button class="button is-link" type="submit">Submit</button>
            </div>

            </div>                                
    </form>
    </div>
</div>

{{-- end of edit products page --}}

{{-- start of show page --}}

@extends('layouts.app')

@section ('content')

{{-- back button to go back on the all products --}}
<a href="/products" class="btn btn-default"> Go Back</a>

{{-- product details/all the fields --}}
<h1>{{$product->title}}</h1>
<hr>
{{-- display the image --}}
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="/gallery/{{$product->thumbnail}}" alt="First slide">
        </div>
        <p hidden>{{$images = DB::table('photos')->where('product_id',$product->id)->get()}}
            <p>
                @foreach ( $images as $image)
                <div class="carousel-item">
                    <img class="d-block w-100" src="/gallery/{{$image->path}}" alt="First slide">                        
                </div>
                @endforeach
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
    </div>
</div>

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
<small>ISbN Number: {{$product->ISBN_NO}}</small>
<hr>
{{-- <hr>
<small>Book Quantity: {{$product->quantity}}</small>
<hr> --}}
<hr>
{{-- not double quotes as we are passing in html and bootstrap --}}
<h3> {!! $stockLevel !!}</h3>
<hr>
<hr>
<small>Published Date: {{$product->published_date}}</small>
<hr>
<hr>
<small>Seller Name: {{$username}}</small>
<hr>
<hr>


{{-- only signed in users will be able to purchase and leave reviews for products --}}
@can('list-edit-products')

{{-- only add products to cart that have quantity greater than 0 --}}
@if($product->quantity > 0)
{{-- button to add the product to the shopping cart with the bellow information  --}}
     <form action="{{route('carts.store')}}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="id" value ="{{ $product->id}}">
          <input type="hidden" name="title" value ="{{ $product->title}}">
          <input type="hidden" name="price" value ="{{ $product->price}}">
          <button type="submit" class="button button-plain"> Add to Cart </button>
     </form>
@endif

{{-- form to add reviews --}}
<form action="{{route('review.store', $product->id)}}" method="POST"> <br>
    @csrf
      
    <label class="label" for="body">User Reviews</label><br>
     <div class="field">
          <label class="label" for="body">Please enter your experience</label>
          <div class="control">
              <input class="input" type="text" name="body" id="body" placeholder="write your experience here"> 
          </div>
      </div>
      <div class="field">
          <label class="label" for="rating">Give this product a rating</label>
          <div class="control">
                    <select class="input" type="number" name="rating">  
                        @for ($i = 1; $i <= 5 ; $i++) 
                            <option value="{{$i}}">{{$i}}</option>    
                        @endfor 
                    </select> 
            </div>
      </div>
     <button type="submit" class="button button-plain"> Leave a review </button>
</form>


{{-- displaying the reviews for the books --}}
<strong>Reviews</strong>
<hr> @foreach ($reviews as $review)
       <hr> 
        <p>User name:{{ DB::table('users')->where('id' , $review->user_id )->value('name')}}</p>
        <p>Review Description:{{$review->body}}</p>
        <p>Review Rating:{{$review->rating}}</p>
        @if(Auth::id() == $review->user_id )
            {!!Form::open(['action'=> ['ReviewController@destroy', $review->id], 'method' => 'POST' , 'class'=> ''])!!}
            {{-- //includes the hidden spoofing method and the submit button --}}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
            {!!Form::close() !!}

            <a href='{{route('review.edit' , $review->id)}}'><button type="button" class="btn btn-primary float-left">Edit Review</button></a>
        @endif
        <hr>
    @endforeach

{{-- <a href='/products/{{ $product->id}}/edit' class='btn btn-default'> Edit Listing </a>

{{-- calling the destroy method 
in contrller and then remove the listing from the application --}}
{{-- {!!Form::open(['action'=> ['ProductController@destroy', $product->id], 'method' => 'POST' , 'class'=> 'pull-right'])!!} --}}
 {{-- //includes the hidden spoofing method and the submit button --}}
    {{-- {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
{!!Form::close() !!}  --}}
@endcan
@endsection

{{-- end of show page --}}



{{-- start of landing page css --}}
@extends('layouts.app')
@section('index')
        <div class="jumbotron text-center">
                <h1>{{$title}}</h1>
                <p>This is a dynamic and friendly website for buying and selling books</p>
                <p><a class="btn btn-primary btn-lg" href="login" role="button">Login</a> <a class="btn btn-primary btn-lg" href="register" role="button">Register</a></p>
        </div>  
                {{-- view all the featured products --}}
                @forelse ($products as $product)
                        <div class="list-group-item">
                                <h3><a href="/products/{{$product->id}}">{{$product->title}}</a></h3>
                                <small> Price of the product {{$product->price}}</small>
                         </div>
                         
                @empty
                        <div><h3> No items found </h3></div>
                @endforelse 
                
                <button><a href="{{ route ("products.index")}}">View all Books</a></button>
{{-- end of landing page --}}


{{-- navbar styling --}}
 <!-- Below code creates the dropwdown carrot to view books, create books and buy books -->
                    {{-- <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href='#' role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Products <span class="caret"></span>
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href='/products'>
                                  Books on Sale  
                                </a>
                                 <a class="dropdown-item" href='/products/create'>
                                  Sell Books  
                                </a>
                            </div>
                    </li> --}}

                    {{-- <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a> --}}

                                            {{-- @can('manage-users')
                                <a class="dropdown-item" href="{{ route('admin.users.index') }}" > User Management </a>
                                <a class="dropdown-item" href="/menu" > Menu </a>
                                <a class="dropdown-item" href="{{ route('categories.index') }}" > Manage Categories </a>
                                <a class="dropdown-item" href="{{ route('conditions.index') }}" > Manage Conditions </a>
                                @endcan --}}
                                {{-- <a class="dropdown-item" href="{{ route('orders.index') }}" > My Orders </a>
                                <a class="dropdown-item" href="{{ route('listings.index') }}" > Sold Items </a>
                                <a class="dropdown-item" href="{{ route('forsale.index') }}" > My Products </a> --}}
{{-- end of navbar styling --}}