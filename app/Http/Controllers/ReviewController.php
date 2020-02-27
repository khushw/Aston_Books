<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Product;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Product $product)
    {
        

        $this->validate(request(), [
            'body' => 'required|max:255',
            'rating' =>'required'
            ]);
        
        $review = $product->addReview([
            'body' => request('body'),
            'rating' => request('rating'),
            'user_id' => auth()->id()
            ]);
     
        if (request()->expectsJson()) {

             return $review->load('owner');
        }

        return back()->with('success' , 'We appreciate your feedback, Thank You!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , Review $review)
    {
        //
        $this->validate($request, [
            'body' => 'required|max:255',
            'rating' =>'required'
        ]);
            // grab all teh fields the user as changed and update with new values
        $review->update($request->all());
        
        // redirect the user back to the product page they were on
        return redirect('/products/'.$review->product_id)->with('success' , 'Your review has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
        $review->delete();

        return back()->with('success' , 'Your review has been removed');
    }
}
