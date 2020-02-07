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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth'])->group(function(){
    Route::resource('/publishers', 'PublisherController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/books', 'BookController');
    Route::resource('/employees', 'EmployeeController');
    Route::resource('/members', 'MemberController');
    Route::get('/catalogs', 'BookController@catalog');
});

Route::get('/publishers-data', 'PublisherController@publisherData');
Route::get('/categories-data', 'CategoryController@categoryData');
Route::get('/books-data', 'BookController@bookData');
Route::get('/employees-data', 'EmployeeController@employeeData');
Route::get('/members-data', 'MemberController@memberData');