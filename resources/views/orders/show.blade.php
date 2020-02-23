@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Orders Details</div>

                <div class="card-body">
                    {{-- this table came from https://getbootstrap.com/docs/4.3/content/tables/ --}}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Product ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Ordered Quantity</th>
                            <th scope="col">Seller Name</th>
                            <th scope="col">Shipped</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                            {{-- for each loop searchs the table and find all orders and then gets their id , email, postcode and option to view details --}}
                            @foreach ($products as $product)
                                <tr>
                                <th scope="row">{{$product->id}}</th>
                                    <td>{{$product->title}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->pivot->quantity}}</td>
                                    <td>{{ DB::table('users')->where('id' , $product->user_id )->value('name')}}</td>
                                    {{-- get the value of shipped if the product id equals the product id on the order products table --}}
                                    <td>
                                        @if (DB::table('order_product')->where(['product_id' => $product->id , 'order_id' => $order->id])->value('shipped') == 0 )
                                            <p style="background-color:red"> Not yet shipped :( </p>
                                        @elseif (DB::table('order_product')->where(['product_id' => $product->id, 'order_id' => $order->id])->value('shipped')  == 1 )
                                            <p style="background-color:green">  Item(s) is on the way! </p>
                                        @endif
                                    </td>
                                </tr>  
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection