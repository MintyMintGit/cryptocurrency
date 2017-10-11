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
Route::get('/','GlobalDataController@index');
Route::get('/crypto','CalculatorController@index');
Route::get('/calculator/{id}','CalculatorController@calc');
Route::get('/crypto/{id}','CryptoCurrenciesController@index');
Route::get('/world','WorldController@index');
Route::get('/world/{id}','WorldController@currency');
Route::get('generateUrl','CryptoCurrenciesController@generateUrl');

