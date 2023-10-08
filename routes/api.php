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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    
    Route::post('login', 'JWTAuthController@login');
  

});

Route::get('prueba/resultados_pruebas','PruebaController@getResultadosPruebas')->name('prueba.resultados');

/**
 * API
 */
Route::group(['middleware' => 'auth:api'], function () {
    //LISTADO DE PRUEBAS ->
    Route::get('prueba/list','PruebaController@index');
    //LISTADO DETALLADO DE PRUEBAS ->
    Route::get('prueba/list_detalles','PruebaController@getPruebasDetalladas');

    //OBTENER PRUEBA SIMPLE DESDE BD POR ID
    Route::get('prueba/prueba_id/{id}','PruebaController@show');
    //OBTENER PUREBA DETALLADA DESDE BD POR ID
    Route::get('prueba/prueba_detallada/{id}','PruebaController@findPruebaDetallada');
    Route::get('prueba/preguntas_prueba/{id}','PruebaController@getListPreguntasPrueba');

    //API'S DE PREGUNTA 
    // Route::get('pregunta/list','API\ControllerPregunta@get_all');
    Route::get('alternativa/list','AlternativaController@index');
    Route::get('prueba/alternativas_pregunta/{id_pregunta}','AlternativaController@show');
    Route::get('prueba/guardar_respuesta/{id_respuesta}','PruebaController@storeRespuesta');

    Route::put('prueba/start_prueba/{id_prueba}','PruebaController@startPrueba');
    Route::get('prueba/time/{id_prueba}','PruebaController@pruebaTime');
    Route::get('prueba/guardar_prueba_rendida/{id_prueba}','PruebaController@storePruebaRendida');

    Route::get('prueba/resultado_prueba/{id_prueba}','PruebaController@getResultadoPrueba');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::delete('/logout', 'JWTAuthController@logout')->name('auth.logout');;

    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});

