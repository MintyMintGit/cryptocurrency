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

Route::get('/globaldataapi', function (Request $request) {
    $globalDatas = \App\GlobalData::orderBy('market_cap_usd', 'DESC')->paginate(100);
    return GlobalDataResource::collection($globalDatas);
})->name('getGlobalDataApi');
Route::get('/displayall', function (Request $request) {
    $globalDatas = \App\GlobalData::orderBy('market_cap_usd', 'DESC')->get();
    return $globalDatas;
})->name('displayAll');

Route::get('/getexchangerates', function (Request $request) {
    $all = \App\ExchangeRate::all();
    return \App\Http\Resources\ExchangeRates::collection($all);
})->name('getExchangeRates');

Route::get('/globaldatanames', function (Request $request) {
    $globalDatas = \App\GlobalData::get(['name', 'symbol', 'price_usd', 'price_usdOld']);
    return $globalDatas;
})->name('GlobalDataNames');

Route::get('search/{id}', function ($id) {
    return \App\Search\Base::searchInListSearch($id);
})->name('searchIn');

Route::post('globaldata/savestatistic', 'GlobalDataController@saveStatistic')->name('saveStatistic');

Route::get('getfulllistsearch', function () {
    return App\Search\  Base::getFullListSearch();
})->name('getFullListSearch');

Route::post('historicaldata/{id}', function ($id) {
    if ($id != null && $id != "") {
        $historicalData = \DB::connection('mysql2')->table(strtolower($id))->get();
        $historicalData = collect($historicalData)->sortBy(function ($temp) {
            return Carbon\Carbon::parse($temp->created_at)->getTimestamp();
        });
        $prices = $historicalData->pluck('price_usd');
        $prices->all();
        return $prices->toJson();
    }
    return false;

})->name('historicalData');

Route::get('/getexchangerateshistory', function (Request $request) {
     return \App\currencyHistory::all();
})->name('getExchangeRatesHistory');