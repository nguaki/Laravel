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

/*****************************
List of working Routes.

//Root directory
Route::get('/', function () {
    //return view('welcome');
    return 'Hello World /root';
});

Route::get('/hello', function () {
    //return view('welcome');
    return 'Hello World from /root/hello';
});

//Need to create a file named about.blade.php under resources/views/pages.
//Note that all you need is to refer to this file name by simply 'about'.
Route::get('/about', function () {
    return view('pages.about');
    
    //Can use slash as well.
    //return view('pages/about');
});

//Allows URL input.
Route::get('/users/{name}/{id}', function ($name,$id) {
    return 'This is user ' . $name . ' with ID of ' . $id;
});
//Need to create a file named about.blade.php under resources/views/pages.
//Note that all you need is to refer to this file name by simply 'about'.
Route::get('/about', function () {
    return view('pages.about');
    
    //Can use slash as well.
    //return view('pages/about');
});
********************************/


//Root directory
//Execution VC of MVC
//Route ==> Controller ==> View
//
Route::get('/', 'PagesController@index'); 

//Need to create a file named about.blade.php under resources/views/pages.
//Note that all you need is to refer to this file name by simply 'about'.
Route::get('/about', 'PagesController@about'); 

Route::get('/services', 'PagesController@services'); 

//One command will create routes to all 7 methods to PostsController
Route::resource('posts', 'PostsController' );
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
