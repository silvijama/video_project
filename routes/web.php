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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:admin-routes')->group(function(){
    Route::resource('/users', 'UsersController');
    Route::resource('/subjects', 'SubjectController');
    Route::get('/index', 'HomeController@index')->name('index');
});

Route::namespace('Editor')->prefix('editor')->name('editor.')->middleware('can:editor-routes')->group(function(){
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/{user}', 'UserController@show')->name('users.show');
    Route::get('/search', 'UserController@searchUser')->name('search');
    Route::get('/index', 'HomeController@index')->name('index');
    Route::resource('/subjects', 'SubjectController');
    Route::resource('/materials', 'MaterialController');
});

Route::namespace('User')->prefix('user')->name('user.')->middleware('can:user-routes')->group(function(){
    Route::get('/index',  'HomeController@index')->name('index');
    Route::get('/materials', 'MaterialController@index')->name('materials.index');
    Route::get('/materials/{material}', 'MaterialController@show')->name('materials.show');
    Route::resource('/subjects', 'SubjectController');
    Route::get('/search', 'SubjectController@searchSubject')->name('search');
});

