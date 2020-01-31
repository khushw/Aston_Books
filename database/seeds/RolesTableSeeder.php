<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //trancuate the database first, so when we run it deletes everything from database and then add data
        Role::truncate();

        Role::create(['name'=> 'admin']);
        Role::create(['name'=> 'user']);
    }
}
