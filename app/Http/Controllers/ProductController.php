<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Condition;
use DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //shows all the listed books for sale.
    public function index()
    {
        //if want to restrict then add ->take(whatever number)->get();
        //paginate creates a new page for every x amount of posts listed. 
        $products = Product::orderBy('created_at','desc')->paginate(5);
        return view('products.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $conditions = DB::table('conditions')->select('id','name')->get();
        //Condition::all('id');
        return view('products.create')->with(['conditions' => $conditions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //valide the following fields from the form to ensure users are filling in correct information
        $this->validate($request,[
            'title' => 'required',
            'price' => 'required',
            'conditionselect'=>'required'
        ]);
        //create Product and store its details in the database
        $product = new Product;
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->condition_id =$request->input('conditionselect');
        $product->save();

       //after a successful listing it will display the below message    
        return redirect('/products')->with('success', 'Your Product is now listed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //function allows you to view a singular product on its seperate page.
    public function show($id)
    {
        //finds the product and then returns the product show page for individual page
        $product  = Product::find($id);
        return view ('products.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //finds the product and then returns the edit page
        $product  = Product::find($id);
        return view ('products.edit')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //valide the following fields from the form to ensure users are filling in correct information
        $this->validate($request,[
            'title' => 'required',
            'price' => 'required'
            //'condition'=>'required'
        ]);
        //create Product and store its details in the database
        $product =  Product::find($id);
        $product->title = $request->input('title');
        $product->price = $request->input('price');
       // $product->condition_id =$request->input('condition');
        $product->save();

       //after a successful listing it will display the below message    
        return redirect('/products')->with('success', 'Your Listing is now updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        $product->delete();

        return redirect('/products')->with('success', 'Your Listing has been removed');
    }
}
