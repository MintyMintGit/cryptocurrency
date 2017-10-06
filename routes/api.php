<?php

use Illuminate\Http\Request;
use App\Http\Resources\GlobalDataResource;
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

Route::get('/GlobalDataApi', function (Request $request) {
    $globalDatas = \App\GlobalData::orderBy('market_cap_usd', 'DESC')->paginate(100);
    return GlobalDataResource::collection($globalDatas);
})->name('getGlobalDataApi');
Route::get('/displayAll', function (Request $request) {
    $globalDatas = \App\GlobalData::orderBy('market_cap_usd', 'DESC')->get();
    return GlobalDataResource::collection($globalDatas);
})->name('displayAll');

Route::get('/getExchangeRates', function (Request $request) {
    $all = \App\ExchangeRate::all();
    return \App\Http\Resources\ExchangeRates::collection($all);
})->name('getExchangeRates');

Route::get('/GlobalDataNames', function (Request $request) {
    $globalDatas = \App\GlobalData::get(['name', 'symbol']);
    return $globalDatas;
})->name('GlobalDataNames');