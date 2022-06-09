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

Route::get('/', function () {
    return view('home');
});

Route::get('/login');
Route::get('/register');

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('sections','SectionsController');
Route::get('SectionFront','SectionsController@show');
Route::get('show_section/{id}', 'SectionsController@show_section');

Route::resource('products','ProductsController');

Route::get('details_product/{id}','ProductsController@show');
Route::get('view_image/{product_name}/{file_name}','ImagesController@show');

Route::group(['middleware'=>['auth']],function(){
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
});

Route::get('/{page}', 'AdminController@index');


