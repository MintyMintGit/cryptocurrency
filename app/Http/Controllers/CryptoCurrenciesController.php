<?php

namespace App\Http\Controllers;

use App\GlobalData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CryptoCurrenciesController extends Controller
{
    public function index($id) {
        $scriptJs = 'crypto.js';
        $crypto = GlobalData::findOrFail($id);
        $bitcoinPrice = GlobalData::find('bitcoin')->price_usd;
        $linkToIcon = "/img/icons/" . $crypto->id . ".png";
        $social = DB::select("select * from crypto_sidebar where Symbol like ?"  , [$crypto->symbol]);
        $charts = true;
//        $historicalData = \DB::connection('mysql2')->table($crypto['name'])->get();
//        $historicalData2 = collect($historicalData)->sortBy(function ($temp, $key) {
//            return Carbon::parse($temp->Date)->getTimestamp(); // if $temp['date'] is still a Carbon instance
//        });
//
//        $historicalData3 = \Psy\Util\Json::encode($historicalData2->toArray());
        return view('CryptoCurrencies.index',compact( 'scriptJs', 'crypto', 'bitcoinPrice', 'linkToIcon', 'social' , 'charts'));
    }
    public function generateUrl() {
        $result = array();
        $temp = GlobalData::all()->toArray();
        foreach ($temp as $key => $value) {
            $str = "https://files.coinmarketcap.com/static/img/coins/32x32/" . str_replace(' ','-',$value['id']) .".png";

            array_push($result, $str);
        }
        return view('CryptoCurrencies.generateUrl', compact('result'));
    }
}
