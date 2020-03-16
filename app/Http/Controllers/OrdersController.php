<?php

namespace App\Http\Controllers;
use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    //calls the auth middlewear function to check whetehr it is a logged in user, if not it wil redirect to login page
    public function __construct(){
        $this->middleware('auth');
    }
        
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //find the id of the user currently logged in
        $id = Auth::id();
        //find all the orders
        $orders = Order::all();

        return view('orders.index')->with(['orders' => $orders , 'id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find the order 
        $order = Order::find($id);
        // find the associated products with the order id
        $products = $order->products;
        $shipped = OrderProduct::all();
       
        return view('orders.show')->with(["order" => $order, "products" => $products,"shipped"=>$shipped]);
    }
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
