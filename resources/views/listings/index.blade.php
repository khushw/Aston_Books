@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sold Products</div>

                <div class="card-body">
                    {{-- this table came from https://getbootstrap.com/docs/4.3/content/tables/ --}}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Product ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Shipping To</th>
                            <th scope="col">Date Sold</th>
                            <th scope="col">Buyer Name</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Shipped</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            {{-- for each loop searchs the table and find all orders came in for this persons listing  --}}
                            @foreach ($listings as $listing)
                            {{-- @if ($listings->shipped == 0 ) --}}
                                {{-- if the logged on user id matches the id on the order then display all their listings --}}
                               @if($listing->shipped ==0 )
                                    @if (Auth::id() == $listing->seller_id)
                                            
                                            <tr style="color:red">
                                                <th scope="row"> {{$listing->order_id}}</th>
                                                <td>  {{$listing->product_id}}</td>
                                                <td>  {{ DB::table('products')->where('id' , $listing->product_id )->value('title')}}</td>
                                                <td> {{$listing->quantity}}</td>
                                                <td>
                                                    Address:    {{ DB::table('orders')->where('id' , $listing->order_id )->value('shipping_address')}} <br>
                                                    City:       {{ DB::table('orders')->where('id' , $listing->order_id )->value('shipping_city')}} <br>
                                                    Postcode:   {{ DB::table('orders')->where('id' , $listing->order_id )->value('shipping_postcode')}} <br>  
                                                </td>
                                                <td>{{ DB::table('products')->where('id' , $listing->product_id )->value('created_at')}}</td>
                                                <td>{{ DB::table('users')->where('id' , DB::table('orders')->where('id' , $listing->order_id )->value('buyer_id') )->value('name')}}</td>
                                                <td><a href="{{route("listings.shipped" , $listing->id)}}"><button type="button" class="btn btn-success float-left">Shipped</button></a></td>
                                                <td> 
                                                    @if ($listing->shipped == 0)
                                                        <p> Ship Me! </p>
                                                    @elseif($listing->shipped == 1)
                                                    <p> Thank you for shipping! </p>
                                                    @endif
                                                </td>
                                            </tr>  
                                    @endif
                                @elseif($listing->shipped == 1 )
                                    @if (Auth::id() == $listing->seller_id)                                         
                                            <tr style="color:green">
                                                <th scope="row"> {{$listing->order_id}}</th>
                                                <td>  {{$listing->product_id}}</td>
                                                <td>  {{ DB::table('products')->where('id' , $listing->product_id )->value('title')}}</td>
                                                <td> {{$listing->quantity}}</td>
                                                <td>
                                                    Address:    {{ DB::table('orders')->where('id' , $listing->order_id )->value('shipping_address')}} <br>
                                                    City:       {{ DB::table('orders')->where('id' , $listing->order_id )->value('shipping_city')}} <br>
                                                    Postcode:   {{ DB::table('orders')->where('id' , $listing->order_id )->value('shipping_postcode')}} <br>  
                                                </td>
                                                <td>{{$listing->updated_at }}</td>
                                                <td>{{ DB::table('users')->where('id' , DB::table('orders')->where('id' , $listing->order_id )->value('buyer_id') )->value('name')}}</td>
                                                <td><a href="{{route("listings.shipped" , $listing->id)}}"><button type="button" class="btn btn-success float-left">Shipped</button></a></td>
                                                <td> 
                                                    @if ($listing->shipped == 0)
                                                        <p> Ship Me! </p>
                                                    @elseif($listing->shipped == 1)
                                                    <p> Thank you for shipping! </p>
                                                    @endif
                                                </td>
                                            </tr>  
                                    @endif 
                                @endif
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection