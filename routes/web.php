<?php

/*main page*/
Route::get('/','GlobalDataController@index')->name('startPage')->middleware('lowercase');
Route::get('/crypto','GlobalDataController@crypto')->name('crypto')->middleware('lowercase');

/*crypto page*/
Route::get('/crypto/{id}','CryptoCurrenciesController@index')->middleware('lowercase');
/*Inner crypto page*/


/*world*/
Route::get('/world','WorldController@index')->name('world')->middleware('lowercase');
/*Currency Profile Page*/
Route::get('/world/{id}','WorldController@currency')->middleware('lowercase');
/*Conversion page*/
Route::get('/calculator','CalculatorController@calc')->name('calculator')->middleware('lowercase');
Route::get('/calculator/{id}','CalculatorController@calc')->middleware('lowercase');



/*specific route*/
Route::get('/storeallfrom','UpdateDataController@storeAllFrom')->middleware('lowercase');
Route::get('/storeexchangerates','UpdateDataController@storeExchangeRates')->middleware('lowercase');
Route::get('/testimage','TestImageController@index')->middleware('lowercase');
Route::get('/updateiconscrypto','TestImageController@updateIconsCrypto')->middleware('lowercase');
Route::get('/currencyperday','TestImageController@currencyPerDay')->middleware('lowercase');
Route::get('/csvToSql','csvToSqlController@index')->middleware('lowercase');
