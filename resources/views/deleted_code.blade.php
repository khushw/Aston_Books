
{{-- saved links --}}

for the shopping cart
https://bootsnipp.com/snippets/K012l
https://fontawesome.com/v4.7.0/icon/shopping-cart - used this for the icons

for the products index page, used bootstrap album webpage



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