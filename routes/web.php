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

Route::get('/panel', 'HomeController@index');

Route::get('{slug}', function () {
    return view('index');
})->where('slug', '^(?!api).*$');


/*Auth::routes(['register' => false]);

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/prueba', 'HomeController@index')->name('prueba');*/
