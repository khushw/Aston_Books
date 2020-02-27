<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $fillable = ['product_id', 'user_id','body','rating'];
    
    public function product()
   {
      return $this->belongsTo('App\Product');
   }

   public function owner()
   {
   		return $this->belongsTo(User::class, 'user_id');
   }
}
