
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