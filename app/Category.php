<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Category extends Model
{
    //
    use Searchable;

    public function products(){

        return $this->belongsToMany('App\Product');
    }

}
