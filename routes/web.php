<?php

use App\Http\Controllers\UserController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
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
Route::get('/grupos_content', 'GruposController@index');
Route::get('/gestion_content/{id}', 'GruposUsuariosController@index');

Route::get('/panel/resultados/{id}', 'HomeController@resultadosServerside');

// Rutas para usuarios
Route::get('/users/datatable', 'UserController@datatable')->name('usuarios.index');
Route::post('/register', [UserController::class, 'store'])->name('usuarios.register');
//Route::post('/users', 'UserController@store')->name('users.store');
Route::post('/users/store/{id?}', 'UserController@store')->name('users.store');

Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');
Route::put('/users/{user}', 'UserController@update')->name('users.update');
Route::get('users/{id}', 'UserController@show')->name('users.show');

//Rutas para Grupos
Route::post('/grupos/store/{id?}', 'GruposController@store')->name('grupos.store');
Route::get('grupos/{id}', 'GruposController@show')->name('grupos.show');
Route::delete('/grupos/{id}', 'GruposController@destroy')->name('grupos.destroy');
Route::put('/grupos/{user}', 'GruposController@update')->name('grupos.update');
Route::post('/grupos/total_usuarios/{id?}', 'GruposController@total_usuarios')->name('grupos.total_usuarios');

//Rutas para Grupos usuarios
Route::post('/grupo_usuario/store/{id?}', 'GruposUsuariosController@store')->name('grupo_usuario.store');
Route::get('/grupo_usuario/excel/{id?}', 'GruposUsuariosController@excel')->name('grupo_usuario.excel');
Route::delete('/grupo_usuario/{id}', 'GruposUsuariosController@destroy')->name('grupo_usuario.destroy');

Route::get('/excel/{id}', function ($id) {
   return Excel::download(new UsersExport($id), 'Reporte.xlsx');
});



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
