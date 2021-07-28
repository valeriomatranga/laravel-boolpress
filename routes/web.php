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

/* Pagine non connesse ad un modello */
Route::get('/', 'HomeController@index');
Route::get('about', 'HomeController@about')->name('about');

/* Route contact OP[1] senza modello */
/* Route::get('contacts', 'HomeController@contacts')->name('contacts');
Route::get('contacts', 'HomeController@sendContactForm')->name('contacts.send');
 */
/* Route Contact OP[2] con modello */
Route::get('contacts', 'ContactController@form')->name('contacts');
Route::post('contacts', 'ContactController@storeAndSend')->name('contacts.send');

/* Route Articol */
Route::get('articols', 'ArticolController@index')->name('articols.index');
Route::get('articols/{articol}', 'ArticolController@show')->name('articols.show');

/* Route Categories */
Route::get('categories/{category:slug}', 'CategoryController@show')->name('categories.show');

/* Route Admin */
Auth::routes();
Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function(){
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::resource('articols', ArticolController::class);
});