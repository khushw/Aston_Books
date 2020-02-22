<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $fillable = ['buyer_id' , 'shipping_email','shipping_name','shipping_address',
                            'shipping_city', 'shipping_postcode', 'shipping_phone' ,'billing_name_on_card',
                            'billing_subtotal', 'billing_tax', 'billing_total', 'error' ];

    //an order will belong to a user relationship
    public function user(){
        return $this->belongsTo('App\User');
    }

    //used pivot to access the quantity, also defiend relationship to products
    public function products(){
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }
}
