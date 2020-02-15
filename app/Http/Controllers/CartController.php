<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('carts.index');
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
        //if the user wants to buy the same book twice, it checks whether the cart has duplicate items
        //if the user does try to add it to the cart again it will say item already exist
        $duplicates = Cart::search(function ($cartItem , $rowId) use ($request){
            return $cartItem->id === $request->id;
        });

        if($duplicates->isNotEmpty()) {
            return redirect()->route('carts.index')->with('success', 'Item is already in your cart!');
        }

        //gets the id price and title of the associated book and add its to the cart
        //1 in the quantity suggest when the user firt adds an item to the cart it adds 1 item
        Cart::add($request->id, $request->title, 1, $request->price)
            ->associate('App\Product');

        return redirect()->route('carts.index')->with('success','Item has been added to your cart');
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
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric'
        ]);

        if($validator->fails()) {
            session()->flash('error', collect(['Quantity must be numeric and is required']));
            return response()->json(['success' => false]);
        }    

        Cart::update($id, $request->quantity);

        session()->flash('success' , 'Quantity was successfully updated');
        return response()->json(['success' => true], 400);
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
        Cart::remove($id);

        return back()->with('success', 'Item has been removed');
    }

    /**
     * Switch item for shopping cart to save for later
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToSaveForLater($id)
    {
        //grab the product
       $product = Cart::get($id);
        //then remove the product
       Cart::remove($id);

       //if the user wants to buy the same book twice, it checks whether the cart has duplicate items
        //if the user does try to add it to the cart again it will say item already exist
        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem , $rowId) use ($id){
            return $rowId === $id;
        });

        if($duplicates->isNotEmpty()) {
            return redirect()->route('carts.index')->with('success', 'Item is already saved for later!');
        }

       Cart::instance('saveForLater')->add($product->id, $product->name, 1, $product->price)->associate('App\Product');

        return redirect()->route('carts.index')->with('success','Item has been saved for later');
    }
}
