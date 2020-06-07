<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Condition;
use App\Product;
use App\Photo;

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
        Photo::truncate();
       // $category1 = Category::select('id')->where('name' , 'Science')->value('id');
        $condition1 = Condition::select('name')->where('name' , 'Used')->value('name');

        for ($i = 1; $i <= 6; $i++){
         Product::create([
            'title' => 'Science Activity ' .$i,
            'description' => 'This book is fantastic. Currently this book is number' .$i,
            'author' => 'Francesca Simon',
            'book_publisher' => 'Orion Publishing Group',
            'published_date' => '2020-06-0' .$i,
            'price' => '1'.$i +'.99',
            'quantity' => $i,
            'weight' => '1',
            'thumbnail' => "book_example.jpg",
            'pages' => '120',
            'user_id' => '1',
            'ISBN_NO' => '978151010231' .$i,
            //'category_id' => $category1,
            'condition_id' => $condition1
        ])->categories()->attach(1);
         }

        $book = Product::find(1);
        $book->categories()->attach(2);

        $book = Product::find(2);
        $book->categories()->attach(3);

        $book = Product::find(3);
        $book->categories()->attach(4);

        $book = Product::find(4);
        $book->categories()->attach(5);

        for ($i = 1; $i <= 6; $i++){
            Photo::create([
               'product_id' =>  $i,
               'path' => "book_photos.jpg"
                ]);
        }

        for ($i = 1; $i <= 6; $i++){
            Photo::create([
               'product_id' =>  $i,
               'path' => "book_photos_2.jpg"
                ]);
        }


    }
}

// thumbnail reference
// https://www.google.com/search?q=cartoon+book+400+x400&tbm=isch&ved=2ahUKEwiPio3fke7pAhUC-4UKHWL8CMIQ2-cCegQIABAA&oq=cartoon+&gs_lcp=CgNpbWcQARgAMgQIIxAnMgQIIxAnMgQIABBDMgcIABCxAxBDMgQIABBDMgcIABCxAxBDMgQIABBDMgQIABBDMgQIABBDMgcIABCxAxBDOgUIABCxAzoHCCMQ6gIQJ1CdkAJYy6gCYImxAmgHcAB4AIABtwGIAdcIkgEEMTQuMZgBAKABAaoBC2d3cy13aXotaW1nsAEK&sclient=img&ei=VAvcXo-QI4L2lwTi-KOQDA&bih=632&biw=1226&safe=images&tbs=sur%3Afmc&hl=en&hl=en#imgrc=N3HzAGQ2G9K6lM

// product image reference
