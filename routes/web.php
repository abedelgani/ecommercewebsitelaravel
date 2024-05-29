<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
/* guest page */
Route::get('/','GuestController@home');
Route::get('/produit/details/{id}','GuestController@productdetails');
Route::get('/produits/{category}/list','GuestController@shop');
Route::post('/produits/search','GuestController@search');

Auth::routes();

//client
Route::get('/client/profile','clientController@profile')->middleware('auth');
Route::post('/client/profile/update','clientController@updateprofile');
Route::get('/client/dashboard','ClientController@dashboard');
Route::get('/client/commandes','ClientController@mescommandes');

Route::get('/home', 'HomeController@index')->name('home');
 Route::post('/client/review/store','clientController@addreview')->middleware('auth');
 Route::post('/client/order/store','CommandesController@store')->middleware('auth');
 Route::get('/client/cart','clientController@cart')->middleware('auth');
 Route::get('/client/lc/{idlc}/delete','CommandesController@lignecommandedestroy')->middleware('auth');
 Route::post('/client/checkout','clientController@checkout')->middleware('auth');
//admin
Route::get('/admin/dashboard','AdminController@dashboard')->middleware('auth','admin');
Route::get('/admin/profile','AdminController@profile')->middleware('auth','admin');//pour afficher la page profile
Route::post('/admin/profile/update','AdminController@updateprofile')->middleware('auth','admin');//pour faire mise a jour de profile
Route::get('/admin/categories','CategoryController@index')->middleware('auth','admin');
Route::post('/admin/category/store','CategoryController@store')->middleware('auth','admin');
Route::get('/admin/category/{id}/delete','CategoryController@destroy')->middleware('auth','admin');
Route::post('/admin/category/update','CategoryController@update')->middleware('auth','admin');


//product route
Route::get('/admin/produit','produitController@index')->middleware('auth','admin');
Route::post('/admin/produit/store','produitController@store')->middleware('auth','admin');
Route::get('/admin/produit/{id}/delete','produitController@destroy')->middleware('auth','admin');
Route::post('/admin/produit/update','produitController@update')->middleware('auth','admin');


