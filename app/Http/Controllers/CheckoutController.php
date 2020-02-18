<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('checkout.index');
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
        //doing some server side validation
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'city' => 'required',
            'postcode' => 'required',
            'address' => 'required',
            'phone' => 'required'       
        ]);

        //just to display the content of the cart in the metadata currently
        $contents = Cart::content()->map(function ($item){
            return $item->model->title.' , '.$item->qty;
        })->values()->toJson();
        //this just dumps everything in the request 
       // dd($request->all());
       
       //to charge the credit card , we can use the library we installed (cartalyst/stripe-laravel) and we have to use a try catch block for it

       try{
           $charge = Stripe::charges()->create([
            'amount' => Cart::total(),
            'currency' => 'GBP',
            'source'   => $request->stripeToken,
            'description' => 'Order',
            //function inside this library that automaticaly sends an emaill when it sees the below contents
            'receipt_email' => $request->email,
            'metadata' => [
                'contents' => $contents,
                'quantity' => Cart::instance('default')->count(),
            ],
           ]);
           
           //if its successful it will destroy the contents of the cart
           Cart::instance('default')->destroy();
           
           //when successful user will be redirected to the thank you page

           return redirect()->route('thankyou.index')->with('success' , 'Thank You for Shopping with Us!');
       }
       //if we do get bad cards coming through we will use the below library to throw an errro for us 
       catch(CardErrorException $e){
           //returns the error cought from the CardErrorException file
           return back()->withErrors('Error! ' .$e->getMessage());
       }
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
