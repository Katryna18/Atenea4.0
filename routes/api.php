<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('person', 'RegisterController@person');

Route::post('person_doco', 'RegisterController@personDoco');

Route::post('registerPerson', 'RegisterController@registerPerson');

Route::post('updatePerson', 'RegisterController@updatePerson');

Route::post('insertMedida', 'RegisterController@insertMedida');

Route::post('getPersonaMedida', 'RegisterController@getPersonaMedida');

Route::get('grupo', 'RegisterController@grupo');

Route::post('person_grafica', 'RegisterController@personGrafica');

Route::post('getHistorico', 'RegisterController@getHistorico');

Route::post('personDelete', 'RegisterController@personDelete');

Route::post('deleteMedida', 'RegisterController@deleteMedida');

