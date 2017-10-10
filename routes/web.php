<?php

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


Route::get('/storeAllFrom','UpdateDataController@storeAllFrom');
Route::get('/storeExchangeRates','UpdateDataController@storeExchangeRates');
Route::get('/','GlobalDataController@index')->name('Home');
//Route::get('/','CalculatorController@index');
Route::get('/calculator/{id}','CalculatorController@calc');

