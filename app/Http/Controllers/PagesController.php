<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    //method to disp
    public function index(){
        $title = 'Welcome to Aston Books';
        // return view('index', compact('title'));  //2 ways of doing this below and this one(passing single value)
        return view('index')->with('title',$title);
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
