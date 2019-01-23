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

Route::get('/', function () {
	$parent_category = App\Model\Category::where('parent_id',0)->get();
    return view('welcome',compact('parent_category'));
});

Route::get('/home', function () {
    return redirect('admin');
});

Auth::routes();

//Admin Routes
Route::get('admin', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function() {
  Route::resource('admin/upload', 'UploadController');
  Route::get('admin/findcategory/{id}', 'UploadController@get_subcategory');
  Route::resource('admin/category', 'CategoryController');
  Route::resource('admin/background', 'BackgroundController');
  Route::resource('admin/tv', 'TelevisionController');
});

Route::get('category/{id}', 'DetailController@category');
Route::get('category/details/{id}', 'DetailController@category_details');

Route::get('file/{id}', 'DetailController@movie_details');
Route::get('search', 'DetailController@search');
Route::get('tv', 'DetailController@tv');