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

Route::get('/home', 'App\Http\Controllers\DataVieuwController@showData');
Route::get('/add', 'App\Http\Controllers\DataAddController@addDataForm');
Route::post('/create', 'App\Http\Controllers\DataAddController@insertIntoDatabase');

