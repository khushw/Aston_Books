<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = ['quantity'];

    public function categories(){

        return $this->belongsToMany('App\Category');
    }
    
    public function condition()
    {
        return $this->hasOne('App\Condition');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function addReview($review)
    {
        return $this->reviews()->create($review);
    }

}