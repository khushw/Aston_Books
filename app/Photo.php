<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $guarded = [];
    
    public function products()
    {
        return $this->belongsTo('App\Product');
    }
}
