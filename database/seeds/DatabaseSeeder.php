<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // calling the roles first as the user depends on the role
        $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
        //when you run php artisan dbseed anything in the above run method will be called
     
    }
}
