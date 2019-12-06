<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    
    public function condition()
    {
        return $this->hasOne('App\Condition');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}