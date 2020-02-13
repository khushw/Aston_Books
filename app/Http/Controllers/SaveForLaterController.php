<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class SaveForLaterController extends Controller
{
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Cart::instance('saveForLater')->remove($id);

        return back()->with('success', 'Item has been removed');
    }

    /**
     * Swith the item from saved to later to the shopping cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToCart($id)
    {
        
         //grab the product instance in the saveForLater
       $product = Cart::instance('saveForLater')->get($id);
       //then remove the product in the saveForLater instances
        Cart::instance('saveForLater')->remove($id);

      //if the user wants to buy the same book twice, it checks whether the cart has duplicate items
       //if the user does try to add it to the cart again it will say item already exist
       $duplicates = Cart::instance('default')->search(function ($cartItem , $rowId) use ($id){
           return $rowId === $id;
       });

       if($duplicates->isNotEmpty()) {
           return redirect()->route('carts.index')->with('success', 'Item is already in your cart!');
       }

      Cart::instance('default')->add($product->id, $product->name, 1, $product->price)->associate('App\Product');

       return redirect()->route('carts.index')->with('success','Item has been moved for cart!');
    }

}
