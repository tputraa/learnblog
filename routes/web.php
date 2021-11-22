<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/','Auth\AuthController@index')->name('login');
Route::post('/','Auth\AuthController@login')->name('login');


// Route::group(['middleware' => 'cekLoginMid'], function(){
Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', function () {return view('index');});    
    Route::get('/post_list','PostController@index');

    //crud post
    Route::get('/post_add','PostController@post_add');
    Route::post('post','PostController@store');
    Route::get('/post_edit/{id}', 'PostController@edit');
    Route::post('/post/update/{id}', 'PostController@update');


    Route::get('/logout','Auth\AuthController@logout');
});
// Route::redirect('/', 'home');

// Route::get('home',function(){
//     return 'welcome';
// });

// Route::get('user/{id}',function($id){
//     return 'welcome '.$id;
// });