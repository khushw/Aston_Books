<?php

namespace App\Http\Controllers;
use App\OrderProduct;
use App\Order;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ListingsController extends Controller
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
        //
        // $id = Auth::id();
        $listings = OrderProduct::all();
        // $orders = Order::all();
       // dd($orders->all());

       return view('listings.index')->with([
                                            "listings" => $listings
                                            // "orders"   => $orders
                                            // "id"       => $id  
                                            ]);
        
    }

    public function shipped($id){
        $product = OrderProduct::find($id);
        $product->shipped = true;
        $product->save();
        return redirect()->back()->with('success', 'This Order has been shipped!');
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
        //
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
