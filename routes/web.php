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
Route::get('/usuarios', 'UserController@index')->name('usuarios.index');
Route::post('/register', [UserController::class, 'store'])->name('usuarios.register');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');
Route::put('/users/{user}', 'UserController@update')->name('users.update');


/*Route::get('/users', [UserController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);*/

Route::get('{slug}', function () {
    return view('index');
})->where('slug', '^(?!api).*$');



/*Auth::routes(['register' => false]);

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/prueba', 'HomeController@index')->name('prueba');*/
