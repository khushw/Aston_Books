<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Stripe;
use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;
use DB;
use App\Notifications\NewOrder;
use App\User;
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
        //display the logged in users email and name in the checkout form
        $email = DB::table('users')->where('id' , Auth::id())->value('email');
        $name = DB::table('users')->where('id' , Auth::id())->value('name');
        
        return view('checkout.index')->with(['email' => $email ,'name' => $name]);
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
        // when a product is out of stock it will throw an error instead of going -1
        if($this->productsAreNoLongerAvaliable()){
            return back()->withErrors('Sorry! One of the items in your cart is no longer avaliable');
        }
        
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
            
        $order = $this->addToOrdersTable($request , null);

        //    send an email confirmation aswell as the order details
           Mail::to($request->email)->send(new OrderPlaced($order));


           $this->decreaseQuantites();


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

    public function addToOrdersTable($request, $error)
    {
       //Insert the cart items into the orders table
     $order = Order::create([
        'buyer_id' => auth()->user() ? auth()->user()->id :null,
        'shipping_email' => $request->email,
        'shipping_name' =>   $request->name,
        'shipping_address' => $request->address,
        'shipping_city'  => $request->city,
       'shipping_postcode' => $request->postcode,
       'shipping_phone' => $request->phone,
       'billing_name_on_card' => $request->name_on_card,
        'billing_subtotal' => Cart::subtotal(), 
        'billing_tax'=> Cart::tax(),
        'billing_total'=> Cart::total(),
        'error' => $error,
        ]);


        $id = auth()->user() ? auth()->user()->id :null;
        if(Auth::id() == $id){
            // $order_id = $order->id->orderBy('created_at', 'desc')->first();  
            $order_id = $order->orderBy('created_at', 'desc')
            ->get('id')->first(); 
            User::find($id)->notify(new NewOrder($order_id)); 
        }

        // $order_id = $order->value('id'); 

      //Insert into the link table, order_product
      foreach (Cart::content() as $item) {
          # code...
          OrderProduct::create([
              'order_id' => $order->id,
              'product_id' => $item->model->id,
              'seller_id' => $item->model->user_id,
              'quantity' => $item->qty,
          ]);
          
      }

       return $order;
    }
     
    // decrease the quantitie that the user has ordered agaisnt the quantity in left in the stock
    protected function decreaseQuantites(){
        // loop through the contents of the cart
        foreach (Cart::content() as $item){
            // find the item id that is in the cart
            $product = Product::find($item->model->id);

            $product->update(['quantity' => $product->quantity - $item->qty]);

        }

    }

    protected function productsAreNoLongerAvaliable(){
        foreach (Cart::content() as $item){
            $product = Product::find($item->model->id);
            if ($product->quantity < $item->qty){
                return true;
            }
        }
        return false;
    }
}
