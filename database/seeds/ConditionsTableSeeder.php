<?php

use Illuminate\Database\Seeder;
use App\Condition;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Category::truncate();
        Condition::truncate();

        $brandNew = Condition::create([
            'name' => 'Brand New',
            'description' => 'Completely unsed book, mint condition'
        ]);

        $used = Condition::create([
            'name' => 'Used',
            'description' => 'Normal wear and tear, scratches and markings on some pages etc'
        ]);
            
    }
}
