<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    return view('test');
});

Route::get('markAsRead',function(){
    // User::find(1)->notify(new NewOrder);
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
    // return view('index');  
})->name('markRead');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Route::get('/users/{id}/{name}', function($id,$name){
//     return 'this is a user ' .$id .'with name '.$name;
// });

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::get('/menu', 'PagesController@menu');


Route::resource('/products', 'ProductController');
Route::resource('/photos','PhotoController');
Route::resource('/categories', 'CategoriesController');
Route::resource('/conditions' ,'ConditionController');





//namespace so we dont need to put admin in front of our controllers
//prefix adds admin to the start of the url 
//admin . adds this to the start of the route
//apply middleware as when user logs in it calls the manage-users gate, is the user an admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController' , ['except' => ['show','create','store']]);
    
});



//for the basket
Route::resource('/carts' ,'CartController');
Route::get('empty', function (){
        Cart::instance('saveForLater')->destroy();
});
//update the cart quantitiy
//Route::patch('/carts/{product}' , 'CartController@update')->name('carts.update');

Route::post('/carts/switchToSaveForLater/{product}' , 'CartController@switchToSaveForLater')->name('carts.switchToSaveForLater');

//these routes are for the save for later option provided to the users, to remove/delte save for later item and also to add to cart 
Route::resource('/saveForLater' , 'SaveForLaterController');
Route::post('/saveForLater/switchToCart/{product}' , 'SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');

Route::resource('/checkout' , 'CheckoutController'); 

Route::resource('/thankyou' , 'ConfirmationController'); 

Route::resource('/orders', 'OrdersController' , ['except' => ['create','store','destroy','edit','update']]);
//to show all the products the user has sold 
Route::resource('/listings' , 'ListingsController'); 
// to notify the buyer that their product has been shipped from the seller
Route::get('/listings/shipped/{id}' , 'ListingsController@shipped')->name('listings.shipped'); 

// to show all the items the user has put on sale
Route::get('/forsale', 'ProductController@forsale')->name('forsale.index');


#Replies
Route::post('/products/{product}/reviews','ReviewController@store')->name('review.store');
Route::delete('/reviews/{review}','ReviewController@destroy')->name('review.delete');
Route::get('/reviews/{review}','ReviewController@edit')->name('review.edit');
Route::patch('/reviews/{review}','ReviewController@update')->name('review.update');

// Route::resource('/reviews' , 'ReviewController'); 
 
// route to navigate to the search bar
Route::get('/search', function () {
    return view('products.search');
});


Route::get('/messages', 'ContactsController@index');
Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');

