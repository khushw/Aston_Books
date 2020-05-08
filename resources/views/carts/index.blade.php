@extends('layouts.app')

@section ('content')
    {{-- checks if the cart quanity is less than 0 or not --}}
    
    @if(Cart::count() > 0 )
                <div class="col-md-4" id="itemCount">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Total item(s) in your cart
                          <span class="badge badge-primary badge-pill">{{ Cart::count()}}</span>
                        </li>
                    </ul>
                </div>

    <div class="container"></div>
        <div class="card">
                <div class="card-header bg-dark text-light">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    Shopping Cart
                    <a href="{{route("products.index")}}" class="btn btn-outline-info btn-sm pull-right" id="continueShopping">Continue Shopping</a>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    @foreach (Cart::content() as $item)
                        <div class="row">
                            <div class="col-xs-2 col-md-2">
                                <img class="img-responsive" src="/gallery/{{$item->model->thumbnail}}" alt="prewiew">
                            </div>
                            <div class="col-xs-4 col-md-6">
                                <h4 class="product-name"><strong>{{$item->model->title}}</strong></h4><h4><small>{{$item->model->description}}</small></h4>
                            </div>
                            <div class="col-xs-6 col-md-4 row">
                                <div class="col-xs-5 col-md-5 text-right" style="padding-top: 5px">
                                    <h6><strong>{{$item->subtotal}} <span class="text-muted">£</span></strong></h6>
                                </div>
                                <div class="col-xs-2 col-md-2">
                                    {{-- <input type="text" class="form-control input-sm" value="1" remove this > --}}
                                    <select class="quantity" data-id="{{$item->rowId}}" data-productQuantity="{{$item->model->quantity}}">
                                        @for ($i = 1; $i <= $item->model->quantity ; $i++)
                                            <option {{$item->qty == $i ? 'selected' : ''}}>{{$i}}</option>    
                                        @endfor
                                    </select>
                                </div>
                                {{-- save for later from cart --}}
                                <div class="col-xs-2 col-md-2">
                                        <form action="{{ route('carts.switchToSaveForLater' , $item->rowId)}}" method="POST">
                                            @csrf
                                            <button type="submit"  title="Save For Later"class="btn btn-outline-info btn-xs">
                                                <svg class="bi bi-bag" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M14 5H2v9a1 1 0 001 1h10a1 1 0 001-1V5zM1 4v10a2 2 0 002 2h10a2 2 0 002-2V4H1z" clip-rule="evenodd"/>
                                                    <path d="M8 1.5A2.5 2.5 0 005.5 4h-1a3.5 3.5 0 117 0h-1A2.5 2.5 0 008 1.5z"/>
                                                </svg>
                                            </button>
                                            {{-- <button type="submit" class="cart-options">Save for Later </button> --}}
                                       </form>
                                </div>
                                {{-- end save for later from cart --}}

                                {{-- remove item from cart --}}
                                <div class="col-xs-2 col-md-2">
                                        <form action="{{ route('carts.destroy', $item->rowId)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit"  title="Remove Item" class="btn btn-outline-danger btn-xs">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                       </form>
                                </div>
                                {{-- end remove item from cart --}}
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    
                    {{-- <hr> --}}
                    {{-- <div class="pull-right">
                        <a href="#" class="btn btn-outline-secondary pull-right">Save For Later</a>
                    </div> --}}
                </div>
                <div class="card-footer">
                    <a href="{{route("checkout.index")}}" class="btn btn-success pull-right">Checkout</a>
                    <div class="pull-right" style="margin: 5px">
                        Subtotal: <b>£{{Cart::subtotal()}}</b>
                    </div>
                </div>
            </div>
            
        @else
            <div class="col-md-4" id="itemCount">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Total item(s) in your Cart
                      <span class="badge badge-primary badge-pill">{{ Cart::count()}}</span>
                    </li>
                    <a href="{{route("products.index")}}" class="button"> Continue Shopping </a>
                </ul>
            </div>
        @endif

        {{-- states the amount of items you have saved for later --}}
        @if(Cart::instance('saveForLater')->count() > 0 )
        
        <div class="col-md-4" id="itemCount">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Total item(s) Saved for Later
                  <span class="badge badge-primary badge-pill">{{ Cart::instance('saveForLater')->count() }}</span>
                </li>
            </ul>
        </div>
    
        {{-- displaying saved for later items --}}
        <div class="card">
            <div class="card-header bg-dark text-light">
                <svg class="bi bi-bag" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14 5H2v9a1 1 0 001 1h10a1 1 0 001-1V5zM1 4v10a2 2 0 002 2h10a2 2 0 002-2V4H1z" clip-rule="evenodd"/>
                    <path d="M8 1.5A2.5 2.5 0 005.5 4h-1a3.5 3.5 0 117 0h-1A2.5 2.5 0 008 1.5z"/>
                </svg>
                Saved for Later
                <a href="{{route("products.index")}}" class="btn btn-outline-info btn-sm pull-right" id="continueShopping">Continue Shopping</a>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                 @foreach (Cart::instance('saveForLater')->content() as $item)
                    <div class="row">
                        <div class="col-xs-2 col-md-2">
                            <img class="img-responsive" src="/gallery/{{$item->model->thumbnail}}" alt="prewiew">
                        </div>
                        <div class="col-xs-4 col-md-6">
                            <h4 class="product-name"><strong>{{$item->model->title}}</strong></h4><h4><small>{{$item->model->description}}</small></h4>
                        </div>
                        <div class="col-xs-6 col-md-4 row">
                            <div class="col-xs-5 col-md-5 text-right" style="padding-top: 5px">
                                <h6><strong>{{$item->subtotal}} <span class="text-muted">£</span></strong></h6>
                            </div>
                            <div class="col-xs-2 col-md-2">
                            </div>
                            {{-- save for later from cart --}}
                            <div class="col-xs-2 col-md-2">
                                <form action="{{ route('saveForLater.switchToCart' , $item->rowId)}}" method="POST">
                                    @csrf
                                    <button type="submit"  title="Add to Cart"class="btn btn-outline-info btn-xs">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </button>
                                </form>
                                
                            </div>
                            {{-- end save for later from cart --}}

                            {{-- remove item from saveforlater --}}
                            <div class="col-xs-2 col-md-2">
                                <form action="{{ route('saveForLater.destroy', $item->rowId)}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit"  title="Remove Item" class="btn btn-outline-danger btn-xs">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                            {{-- end remove item from saveforlater --}}
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
     

        {{-- if you have no items saved for later --}}
     
        @else 
        <div class="col-md-4" id="itemCount">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Total item(s) Saved for Later
                  <span class="badge badge-primary badge-pill">{{ Cart::instance('saveForLater')->count() }}</span>
                </li>
            </ul>
        </div>
        @endif

    </div>

@endsection

@section('extra-js')
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script>
        // ensure all the content is laoded and then run the below script
       document.addEventListener('DOMContentLoaded', function () {
           const classname = document.querySelectorAll('.quantity')
              
           Array.from(classname).forEach(function(element){
               element.addEventListener('change', function(){
                const id = element.getAttribute('data-id')
                const productQuantity = element.getAttribute('data-productQuantity')
               
                axios.patch(`/carts/${id}`, {
                    quantity: this.value,
                    productQuantity: productQuantity
                })
                .then(function (response) {
                    window.location.href = '{{ route ('carts.index') }}'
                     //console.log(response);
                })
                .catch(function (error) {
                    window.location.href = '{{ route ('carts.index') }}'
                    //console.log(error);
                });
               })
           })
        });
    // alert('hi');
    </script>
    
@endsection