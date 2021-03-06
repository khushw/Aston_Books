<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //function suggest, user belongs to many roles
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    //function suggest, user can list several products
    public function product()
    {
        return $this->hasMany('App\Product');
    }

    // for the current user check the roles the relationship and are there any roles in the roles table
    //if any roles assigned check the first one
    public function hasAnyRoles($roles){

        if($this->roles()->whereIn('name',$roles)->first()){
        //if there is a match than return true
        return true;
    }
        return false;
    }

    public function hasRole($role){

        if($this->roles()->where('name',$role)->first()){
        //if there is a match than return true
        return true;
    }
        return false;
    }

    public function orders(){
        return $this->hasMany('App\Order');
    }
 }
