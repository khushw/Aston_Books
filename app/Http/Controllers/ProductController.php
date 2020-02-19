<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Condition;
use DB;
use Illuminate\Support\Facades\Auth;
use Gate;
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
        if(Gate::denies('list-edit-products')){
            return redirect(route('login'));
        }

        $conditions = DB::table('conditions')->select('id','name')->get();
        $categories = DB::table('categories')->select('id','name')->get();
        //Condition::all('id');
        return view('products.create')->with([
                                            'conditions' => $conditions,
                                            'categories' => $categories
                                            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //to get the id of the user 
        $id = Auth::id();
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
        $product->user_id =$id;
        $product->description = $request->input('description');
        $product->author = $request->input('author');
        $product->book_publisher = $request->input('publisher');
        $product->weight= $request->input('weight');
        $product->pages= $request->input('pages');
        $product->quantity = $request->input('quantity');
        $product->published_date = $request->input('published_date');
        // /$product->category_id =$request->input('categoryselect');
        $product->save();

        $product->categories()->sync($request->input('categories1'));
        


       //after a successful listing it will display the below message
       //then use the success in the inc (messages file) to display some interactive features    
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
        $conditions=DB::table('conditions')->where('id',$product->condition_id)->value('name');
        $username = DB::table('users')->where('id',$product->user_id)->value('name');
        $kilosymbol = "kg";
        $currency = "£";
        return view ('products.show')->with([   'product'=>$product,
                                                'conditions'=>$conditions,
                                                'currency'  => $currency,
                                                'kilosymbol'=> $kilosymbol,
                                                'username' => $username
                                            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('list-edit-products')){
            return redirect(route('products.index'));
        }
        //finds the product and then returns the edit page
        $product  = Product::find($id);
        
        $conditions = DB::table('conditions')->select('id','name')->get();
        $categories = DB::table('categories')->select('id','name')->get();
        

        $conditionname = DB::table('conditions')->where('id',$product->condition_id)->value('name');
        $conditionid = DB::table('conditions')->where('id',$product->condition_id)->value('id');

       // $categoriesname = DB::table('categories')->where('id',$product->category_id)->value('name');
        //  $categoriesid = DB::table('categories')->where('id', $product->category_id)->value('id');

        return view ('products.edit')->with([   'conditions' => $conditions,
                                                'product'=>$product,
                                                'conditionid' =>$conditionid,
                                                'conditionname' => $conditionname,
                                                'categories' => $categories
                                                //'categoriesname' => $categoriesname,
                                               // 'categoriesid'   => $categoriesid
                                            ]);
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
        $product->condition_id =$request->input('conditionselect');
        $product->description = $request->input('description');
        $product->author = $request->input('author');
        $product->book_publisher = $request->input('publisher');
        $product->weight= $request->input('weight');
        $product->pages= $request->input('pages');
        $product->quantity = $request->input('quantity');
        $product->published_date = $request->input('published_date');
        $product->save();

        //use synce as its an array, we update the categires fo the prodcts in the relationship table
        $product->categories()->sync($request->input('categories1'));

       //after a successful listing it will display the below message    
        return redirect("/products/".$product->id)->with('success', 'Your Listing is now updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //rediret the user back to the products index page is not signed in 
        if(Gate::denies('list-edit-products')){
            return redirect(route('products.index'));
        }

        $product = Product::find($id);
       
       //it will delete the product and detach any catgories attached with the product
        $product->categories()->detach();
       
        $product->delete();

        
        

        return redirect('/products')->with('success', 'Your Listing has been removed');
    }
}
