<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:admin-routes')->group(function(){
    Route::get('/api_subjects/get_subjects',  'ApiSubjectController@getSubjects');
    Route::resource('/api_subjects', 'ApiSubjectController');
    
});
