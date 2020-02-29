<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

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

    // return all products to algolia that have quantity greater than 0
    public function shouldBeSearchable()
    {
        return $this->quantity > 0;
    }

    // find all the categories that belong to a product
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $extraFields = [
            'categories' => $this->categories()->pluck('name')->toArray(),
        ];
        

        return array_merge($array , $extraFields);
    }
}