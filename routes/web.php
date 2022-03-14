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

Route::get('/','PagesController@index')->name('index');
Route::get('/books/singel','BooksController@show')->name('books.show');
Route::get('/books/upload/new','BooksController@create')->name('books.upload');
Route::post('/books/upload/post','BooksController@store')->name('books.store');

Route::get('/admin','backend\PagesController@index')->name('index');
Route::get('/books/categories/{slug}','backend\CategoriesController@show')->name('categories.show');

//admin
Route::group(['prefix' => 'admin'],function(){
	Route::get('/admin','Backend\PagesController@index')->name('admin.index');

});

Route::group(['prefix' =>'user'],function(){

	Route::get('/profile/{username}','UsersController@profile')->name('users.profile');
	Route::get('/profile/{username}/books','UsersController@books')->name('users.books');
});

//Books
Route::group(['prefix' => 'books'],function(){
	Route::get('/','Backend\BooksController@index')->name('admin.books.index');
	//Route::get('/{id}','Backend\BooksController@show')->name('admin.books.show');
	Route::get('/create','Backend\BooksController@create')->name('admin.books.create');
	Route::get('/edit/{id}','Backend\BooksController@edit')->name('admin.books.edit');
	Route::post('/update/{id}','Backend\BooksController@update')->name('admin.books.update');
	Route::post('/store','Backend\BooksController@store')->name('admin.books.store');
	Route::post('/delete/{id}','Backend\BooksController@delete')->name('admin.books.delete');
	
});

//Authors
Route::group(['prefix' => 'authors'],function(){
	Route::get('/','Backend\AuthorsController@index')->name('admin.authors.index');
	Route::post('/store','Backend\AuthorsController@store')->name('admin.authors.store');
	Route::get('/{id}','Backend\AuthorsController@show')->name('admin.authors.show');
	Route::post('/update/{id}','Backend\AuthorsController@update')->name('admin.authors.update');
	Route::post('/delete/{id}','Backend\AuthorsController@delete')->name('admin.authors.delete');
	
});



//Categories
Route::group(['prefix' => 'categories'],function(){
	Route::get('/','Backend\CategoriesController@index')->name('admin.categories.index');
	Route::post('/store','Backend\CategoriesController@store')->name('admin.categories.store');
	Route::get('/{id}','Backend\CategoriesController@show')->name('admin.categories.show');
	Route::post('/update/{id}','Backend\CategoriesController@update')->name('admin.categories.update');
	Route::post('/delete/{id}','Backend\CategoriesController@delete')->name('admin.categories.delete');
	
});

//publisher
Route::group(['prefix' => 'publishers'],function(){
	Route::get('/','Backend\PublisherController@index')->name('admin.publishers.index');
	Route::post('/store','Backend\PublisherController@store')->name('admin.publishers.store');
	Route::get('/{id}','Backend\PublisherController@show')->name('admin.publishers.show');
	Route::post('/update/{id}','Backend\PublisherController@update')->name('admin.publishers.update');
	Route::post('/delete/{id}','Backend\PublisherController@delete')->name('admin.publishers.delete');
	
});
Auth::routes(['verify' =>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
