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
// Route::get('/','PostController@index');

Route::get('/', [
    'uses' => 'PostController@index'
]);

Route::get('/post/{id}/detailpost', [
    'uses' => 'PostController@show',
    'as'=>'post.detail',
]);

Route::get('/post/{id}/delete', [
    'uses' => 'PostController@destroy',
    'as'=>'post.delete',
]);

Route::get('/post/create', [
    'uses' => 'PostController@create',
    'as'=>'post.create',
])->middleware('auth');

Route::get('/posts/mypost',[
    'uses'=> 'PostController@mypost',
    'as'=>'myposts',
]);
Route::get('/searchPost',[
    'uses'=> 'PostController@searchPost',
    'as'=>'searchPost',
]);
Route::get('/searchPostt',[
    'uses'=> 'PostController@searchPostt',
    'as'=>'searchPostt',
]);

Route::post('/store', [
    'uses' => 'PostController@store',
    'as'=>'post.storeee',
]);

Route::post('/', [
    'uses' => 'RegisterController@store',
    'as'=>'register.store',
]);
Route::post('/addCategory',[
    'uses' => 'CategoryController@store',
    'as'=>'category.store',
]);
Route::get('/showCategory',[
    'uses' => 'CategoryController@showCategory',
    'as'=>'category.show',
]);
Route::get('/category/create',[
    'uses' => 'CategoryController@index',
    'as'=>'category.index',
]);
Route::get('/category/{id}/edit',[
    'uses' => 'CategoryController@edit',
    'as'=>'category.edit',
]);
Route::post('/category/{id}/update',[
    'uses' => 'CategoryController@update',
    'as'=>'category.update',
]);
Route::get('/category/{id}/delete', [
    'uses' => 'CategoryController@destroy',
    'as'=>'category.delete',
]);
Route::get('/categoryadd',[
    'uses' => 'CategoryController@categoryNew',
    'as'=>'category.new',
]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/cart',[
    'uses'=>'CartController@cart',
    'as'=> 'cart.show',
]);

Route::get('/post/{id}/edit', [
    'uses' => 'PostController@edit',
    'as'=>'post.edit',
]);

Route::post('/post/{id}/update', [
    'uses' => 'PostController@update',
    'as'=>'post.update',
]);

Route::get('/category','CategoryController@index')->name('category');

Route::get('user/new', [
    'uses' => 'UserController@register',
    'as'=>'user.new',
]);
Route::post('user/store', [
    'uses' => 'UserController@store',
    'as'=>'user.store',
]);
Route::get('user/edit/{id}',[
    'uses' => 'UserController@edit',
    'as'=> 'user.edit',
]);
Route::get('user/show',[
    'uses'=>'UserController@show',
    'as'=>'user.show',
]);
Route::post('user/update/{id}',[
    'uses' => 'UserController@update',
    'as'=> 'user.update',
]);
Route::get('/user/{id}/delete', [
    'uses' => 'UserController@destroy',
    'as'=>'user.delete',
]);
Route::get('/cart/add/{id}', [
    'uses' => 'CartController@addCart',
    'as' => 'cart.add'
]);
Route::get('/addComment/{id}', [
    'uses'=>'PostController@addComment',
    'as'=>'post.comment',
]);
Route::resource('comment', 'CommentController');
Route::get('/cart/delete/{pid}', [
    'uses' => 'CartController@destroy',
    'as' => 'cart.delete'
]);