<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //trancuate the users table
        User::truncate();
        //empty the table that links the roles to the users
        DB::table('role_user')->truncate();


        //find the roles 
        $adminRole = Role::where('name' , 'admin')->first();
        $userRole = Role::where('name' , 'user')->first();

        //create the users 

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password'=> Hash::make('khush')
        ]);

        $user = User::create([
            'name' => 'Generic User',
            'email' => 'user@user.com',
            'password'=> Hash::make('khush')
        ]);

        //attaches the admin role to the admin user
        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);    

    }
}
