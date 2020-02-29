<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Condition;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::truncate();
       // $category1 = Category::select('id')->where('name' , 'Science')->value('id');
        $condition1 = Condition::select('name')->where('name' , 'Used')->value('name');

        for ($i = 1; $i <= 6; $i++){
         Product::create([
            'title' => 'Book' .$i,
            'description' => 'This book' .$i,
            'author' => 'James',
            'book_publisher' => 'Khush',
            'price' => '123',
            'quantity' => '2',
            'weight' => '1',
            'pages' => '120',
            'user_id' => '1',
            'ISBN_NO' => 'ISBN123' .$i,
            //'category_id' => $category1,
            'condition_id' => $condition1
        ])->categories()->attach(1);
         }

        $book = Product::find(1);
        $book->categories()->attach(1);

    }
}
