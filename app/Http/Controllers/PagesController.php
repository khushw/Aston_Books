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
        $products = Product::where('featured' , true)->take(3)->inRandomOrder()->get(); 
        // /dd($products->all());
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
