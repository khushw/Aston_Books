<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Product;
use App\Condition;
use App\Photo;
use App\Category;
use App\Review;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        // $pagination = 3;

        $categories = Category::all();
        // check the query string for the category 
        if(request()->category) {
            // if there is a query string, we will find the category that equals the query and get all the products that match
            // show products which have quantity greater than or equal to 1
            $products = Product::with('categories')->where('quantity', '>=' , '1')->whereHas('categories', function($query){
                $query->where('name' , request()->category);
            });
            //find the cateogry that the user has selected, use first as its collection of cateogires
            //used the optional helper in case the category doesnt exist
            $categoryName = optional($categories->where('name' , request()->category)->first())->name;
        } else {   //if no query string do the below code
          
            //$products = Product::where('featured' , true);
            // if want to display all the books for sale
            $products = Product::take(10000)->where('quantity', '>=' , '1'); 
            // to retrieve all the categories
            $categoryName = 'Books Avaliable!';
        }

        //for the price low to high or vice versa we check the sort like we defined in the index view
        // added pagination here as it only works with query builder and there is no query builder here
        if(request()->sort == "low_high"){
            $products = $products->orderBy('price')->paginate(6);
        } elseif (request()->sort == "high_low") {
            $products = $products->orderBy('price', 'desc')->paginate(6);
        } elseif (request()->sort == "date_listed_earliest") {
            $products = $products->orderBy('created_at')->paginate(6);
        } elseif (request()->sort == "date_listed_longest") {
            $products = $products->orderBy('created_at', 'desc')->paginate(6);
        } else {
            $products = $products->paginate(6);
        }

        return view('products.index')->with([
                                            'products' => $products,
                                            'categories' => $categories,
                                            'categoryName' => $categoryName
                                            ]);
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

        $conditions = DB::table('conditions')->select('id','name','description')->get();
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
        // // valide the following fields from the form to ensure users are filling in correct information
        // $this->validate($request,[
        //     'title' => 'required',
        //     'price' => 'required',
        //     'ISBN_NO' => 'required',
        //     'conditionselect'=>'required'
        // ]);

        if($request->hasfile('thumbnail'))
        {
            $thumb = $request->file('thumbnail');
            $name = pathinfo($thumb->getClientOriginalName(), PATHINFO_FILENAME);
            $filename =  $name.'-'.time().'.'.$thumb->getClientOriginalExtension();
            $location = public_path('./publc/photos/' . $filename);
            $thumb->move(public_path().'/gallery/',$filename);
        }

    //     //create Product and store its details in the database
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
        $product->ISBN_NO= $request->input('ISBN_NO');
        $product->quantity = $request->input('quantity');
        $product->published_date = $request->input('published_date');  
        $product->thumbnail = $filename;  
        $product->save();

        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image) {

                $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

                $filename =  $name.'-'.time().'.'.$image->getClientOriginalExtension();
                $location = public_path('./publc/photos/' . $filename);
                $image->move(public_path().'/gallery/',$filename);
 
                $photo = new Photo;
                $photo->product_id = $product->id;
                $photo->path = $filename;
                $photo->save();  
            }
    
        }
        
        // once the product is created it will then sync its categories
        $product->categories()->sync($request->input('categories1'));
        $product->save();

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
        $conditions=DB::table('conditions')->where('name',$product->condition_id)->value('name');
        $username = DB::table('users')->where('id',$product->user_id)->value('name');
        $kilosymbol = "kg";
        $currency = "£";
        //indicate whether an item is stock
        if ($product->quantity >= 1){
            $stockLevel = '<span class="badge badge-pill badge-success">' .$product->quantity. ' In Stock</span>';    
        } elseif ($product->quantity <= 0){
            $stockLevel = '<span class="badge badge-pill badge-secondary">Not Avaliable</span>';    
        }

        // get the reviews
        $reviews = Review::where('product_id' , $id)->get();
        
        return view ('products.show')->with([   'product'=>$product,
                                                'conditions'=>$conditions,
                                                'currency'  => $currency,
                                                'kilosymbol'=> $kilosymbol,
                                                'stockLevel'=> $stockLevel,
                                                'reviews' => $reviews,
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
        

        $conditionname = DB::table('conditions')->where('name',$product->condition_id)->value('name');
        $conditionid = DB::table('conditions')->where('id',$product->condition_id)->value('id');

        return view ('products.edit')->with([   'conditions' => $conditions,
                                                'product'=>$product,
                                                'conditionid' =>$conditionid,
                                                'conditionname' => $conditionname,
                                                'categories' => $categories
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
            'price' => 'required',
            'ISBN_NO' => 'required'
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
        $product->ISBN_NO= $request->input('ISBN_NO');
        $product->quantity = $request->input('quantity');
        $product->published_date = $request->input('published_date');
        //use synce as its an array, we update the categires fo the prodcts in the relationship table
        $product->categories()->sync($request->input('categories1'));
        $product->save();


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
        File::delete(public_path('/gallery/'.$product->thumbnail_path));
        

        $image = DB::table('images')->where('product_id', $id)->get();
        foreach($image as $im){            
            File::delete(public_path('/gallery/'.$im->path));
            $animage = Image::find($im->id);
            $animage->delete();   
        }
        $product->delete();

        
        

        return back()->with('success', 'Your Listing has been removed');
    }

    public function forsale(){

        $products = Product::all();

        return view('forsale.index')->with(['products' => $products]);

    }
}
