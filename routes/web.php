<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'RegisterController@show');

Route::get('/show', 'RegisterController@show');

Route::get('/register', 'RegisterController@register');

Route::get('/dashboard/{documento}', 'RegisterController@metrica');
