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
    $globalDatas = \App\GlobalData::get(['name', 'symbol', 'price_usd']);
    return $globalDatas;
})->name('GlobalDataNames');

Route::get('search/{id}', function ($id) {
    return \App\Search\Base::searchInListSearch($id);
})->name('searchIn');

Route::post('GlobalData/saveStatistic', 'GlobalDataController@saveStatistic')->name('saveStatistic');

Route::get('getFullListSearch', function () {
    return App\Search\  Base::getFullListSearch();
})->name('getFullListSearch');

Route::post('historicalData/{id}', function ($id) {
    if($id != null && $id != "") {
        $historicalData = \DB::connection('mysql2')->table($id)->get();
        $newEmptyCollection = array();
        $historicalData = collect($historicalData)->sortBy(function ($temp, $key) {
            return Carbon\Carbon::parse($temp->Date)->getTimestamp();
        });
        //return \Psy\Util\Json::encode($newEmptyCollection);
//        unset($historicalData->rooms['id']);
  //      $property->rooms->values();
        //$historicalData->forget('id');

        $prices = $historicalData->pluck('High');
        $prices->all();
        return $prices->toJson();
    }
    return false;

})->name('historicalData');
