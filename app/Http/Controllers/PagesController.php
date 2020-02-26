<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class PagesController extends Controller
{
    //
    //method to disp
    public function index(){
        $title = 'Welcome to Aston Books';           
       //on the home page display all the products where featured is 3 and show only 3 in random order
        $products = Product::where('featured' , true)->take(3)->inRandomOrder()->get(); 
        // return view('index', compact('title'));  //2 ways of doing this below and this one(passing single value)
        return view('index')->with  ([
                                        'title' => $title,
                                        'products' => $products
                                    ]);
    }

    public function about(){
        $title = 'About Us';
        // return view('index', compact('title'));  //2 ways of doing this below and this one(passing single value)
        return view('about')->with('title',$title);
    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['Purchasing books', 'Selling books']
        );
        return view('services')->with($data);
    }
}
