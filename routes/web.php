<?php

use App\Http\Controllers\Admin\HomeController;
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

/* Route Guest  */
Route::get('/', 'HomeController@index');
Route::get('about', 'HomeController@about');
Route::get('contacts', 'HomeController@contacts');

Route::get('articols', 'ArticolController@index')->name('articols.index');
Route::get('articols/{articol}', 'ArticolController@show')->name('articols.show');

Auth::routes();


/* Route Admin */
Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function(){
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::resource('articols', ArticolController::class);
});