<?php

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

Route::get('/', function () {
    return view('auth.login');
    

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('finances', 'App\Http\Controllers\FinancesController' );
Route::resource('govers', 'App\Http\Controllers\GoversController' );
Route::resource('contracts', 'App\Http\Controllers\ContractsController' );
Route::resource('companies', 'App\Http\Controllers\CompaniesController' );
Route::resource('subjects', 'App\Http\Controllers\SubjectsController' );
Route::get('/{page}', 'App\Http\Controllers\AdminController@index');

