<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users',function($user){
            return $user->hasRole('admin'); //returns true if the user is a admin
        });
        //using gate as it allows you to define certain logic to reduce repitition e.g. if we wnna create a check if user is admin and we change ur mind later, we have to chage that in controller
        //goes to the auth service prvider gate
        //then from there goes to the hasRole function in the USersController and checks if they have admin role
        
        Gate::define('edit-users',function($user){
            return $user->hasRole('admin');
        });
        //same as above but for deleting users, only permit admin to delete users
        Gate::define('delete-users',function($user){
            return $user->hasRole('admin');
        });

        //only allow a registerd user to list a product for sale aswell as edit a product
        Gate::define('list-edit-products',function($user){
            return $user->hasAnyRoles(['user','admin']);
        });
        
    }
}
