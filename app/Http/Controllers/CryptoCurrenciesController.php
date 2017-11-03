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
