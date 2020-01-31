<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //below function says , this belongs to many users as a several users can have the same role
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
