@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Orders</div>

                <div class="card-body">
                    {{-- this table came from https://getbootstrap.com/docs/4.3/content/tables/ --}}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Order Email</th>
                            <th scope="col">Shipping Address</th>
                            <th scope="col">Total Tax Paid</th>
                            <th scope="col">Total Cost Paid</th>
                            {{-- <th scope="col">Shipped</th> --}}
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            {{-- for each loop searchs the table and find all orders and then gets their id , email, postcode and option to view details --}}
                            @foreach ($orders as $order)
                            {{-- if the logged on user id matches the id on the order then display all their orders --}}
                            @if ($id == $order->buyer_id)
                                <tr>
                                <th scope="row">{{$order->id}}</th>
                                    <td>{{$order->shipping_email}}</td>
                                    <td>
                                        Address: {{$order->shipping_address}} <br>
                                        City: {{$order->shipping_city}} <br>
                                        Postcode:{{$order->shipping_postcode}} <br>
                                    </td>
                                    <td>{{$order->billing_tax}}</td>
                                    <td>{{$order->billing_total}}</td>
                                    {{-- <td>
                                        @if ($order->shipped == 0 )
                                            <p style="background-color:red"> Not yet shipped :( </p>
                                        @elseif ($order->shipped == 1 )
                                            <p style="background-color:green">  Item(s) is on the way! </p>
                                        @endif
                                        {{-- {{$order->shipped}} 
                                    </td> --}}
                                    <td>
                                        <a href="/orders/{{$order->id}}"><button type="button" class="btn btn-primary float-left">View Details</button></a> 
                                    </td>
                                </tr>  
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