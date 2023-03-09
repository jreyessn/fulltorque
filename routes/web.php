<?php

use App\Http\Controllers\UserController;
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

// HTML para cargarlo desde React
Route::get('/panel_content', 'HomeController@index');
Route::get('/usuarios_content', 'UserController@index');
Route::get('/panel/resultados/{id}', 'HomeController@resultadosServerside');

// Rutas para usuarios
Route::get('/usuarios/datatable', 'UserController@datatable')->name('usuarios.index');
Route::post('/register', [UserController::class, 'store'])->name('usuarios.register');
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');
Route::put('/users/{user}', 'UserController@update')->name('users.update');
Route::get('users/{id}', 'UserController@show')->name('users.show');

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
