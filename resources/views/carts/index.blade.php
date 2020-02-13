@extends('layouts.app')

@section ('content')
    {{-- checks if the cart quanity is less than 0 or not --}}
    @if(Cart::count() > 0 )
        <h2>{{ Cart::count()}} item(s) in the cart </h2>
    
    <div class="cart-table">
        @foreach (Cart::content() as $item)
        <div class="cart-table-row">
            <div class="cart-table-row-left">
                <a> Image will be here, refence from the image</a>
                <div class="cart-item-details"> 
                    <div class="cart-table-item"><a href="/products/{{$item->id}}"> {{$item->model->title}}</a></div>
                    <div class="cart-table-description"> {{$item->model->description}} </div>
                    <div class="cart-table-price"> ${{$item->model->price}} </div>
                </div>
            </div>
            <div class="cart-table-row-right">
                <div class="cart-item-actions"> 
                    
                    <form action="{{ route('carts.destroy', $item->rowId)}}" method="POST">
                         {{ csrf_field() }}
                         {{ method_field('DELETE') }}
                         <button type="submit" class="cart-options">Remove </button>
                    </form>
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

     @else 
        <h3> No items in cart</h3>
        <div class="spacer"></div>
        <a href="{{route("products.index")}}" class="button"> Continue Shopping </a>
        <div class="spacer"></div>
    @endif
    {{-- states the amount of items you ahve saved for later --}}
    @if(Cart::instance('saveForLater')->count() > 0 )

    <h2>{{ Cart::instance('saveForLater')->count() }} item(s) Saved for Later </h2>
    
    {{-- displaying the saved for later items --}}
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

    @else 
    <h3>You have no items saved for later</h3>
    @endif


@endsection