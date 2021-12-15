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


Route::get('', [\App\Http\Controllers\CompanyController::class, 'login']); 
Route::get('/home', [\App\Http\Controllers\CompanyController::class, 'show']);
Route::get('/add', [\App\Http\Controllers\CompanyController::class, 'create']);
Route::post('/add/create', [\App\Http\Controllers\CompanyController::class, 'store']);
Route::get('/delete/{id}', [\App\Http\Controllers\CompanyController::class, 'destroy']);
Route::get('/edit/{id}', [\App\Http\Controllers\CompanyController::class, 'edit']);
Route::post('/edit/update/{id}', [\App\Http\Controllers\CompanyController::class, 'update']);