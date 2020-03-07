<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // so we can assign data to all the columns
    protected $guarded = [];

    public function fromContact(){
        return $this->hasOne(User::class , 'id' , 'from');
    }
}
