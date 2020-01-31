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

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/users/{id}/{name}', function($id,$name){
//     return 'this is a user ' .$id .'with name '.$name;
// });

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::resource('/products', 'ProductController');

//namespace so we dont need to put admin in front of our controllers
//prefix adds admin to the start of the url 
//admin . adds this to the start of the route
//apply middleware as when user logs in it calls the manage-users gate, is the user an admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController' , ['except' => ['show','create','store']]);
    
});