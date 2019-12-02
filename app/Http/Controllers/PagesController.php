<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    //method to disp
    public function index(){
        return view('index');
    }

    public function about(){
        return view('about');
    }

    public function services(){
        return view('services');
    }
}
