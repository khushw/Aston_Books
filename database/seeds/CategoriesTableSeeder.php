<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
        //trancuate the categories table
        Category::truncate();
        
        $science = Category::create([
            'name' => 'Science'
        ]);
        
        $maths = Category::create([
            'name' => 'Maths'
        ]);

        $Fiction = Category::create([
            'name' => 'Fiction'
        ]);

        $NonFiction = Category::create([
            'name' => 'Non-Fiction'
        ]);

        $ComputingWithBusiness = Category::create([
            'name' => 'Computing with Business'
        ]);

        $Engineering = Category::create([
            'name' => 'Engineering'
        ]);
    }
}
