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


Route::get('/storeAllFrom','UpdateDataController@storeAllFrom')->middleware('lowercase');
Route::get('/storeExchangeRates','UpdateDataController@storeExchangeRates')->middleware('lowercase');
Route::get('/','GlobalDataController@index')->name('startPage')->middleware('lowercase');
Route::get('/calculator','CalculatorController@calc')->name('calculator')->middleware('lowercase');
Route::get('/calculator/{id}','CalculatorController@calc')->middleware('lowercase');
Route::get('/crypto','GlobalDataController@crypto')->name('crypto')->middleware('lowercase');
Route::get('/crypto/{id}','CryptoCurrenciesController@index')->middleware('lowercase');
Route::get('/world','WorldController@index')->name('world')->middleware('lowercase');
Route::get('/world/{id}','WorldController@currency')->middleware('lowercase');
Route::get('generateurl','CryptoCurrenciesController@generateUrl')->middleware('lowercase');
Route::get('/testImage','TestImageController@index')->middleware('lowercase');
Route::get('/updateiconscrypto','TestImageController@updateIconsCrypto')->middleware('lowercase');
Route::get('/currencyperday','TestImageController@currencyPerDay')->middleware('lowercase');
Route::get('/csvToSql','csvToSqlController@index')->middleware('lowercase');
