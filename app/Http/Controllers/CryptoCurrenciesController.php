<?php

namespace App\Http\Controllers;

use App\GlobalData;
use Illuminate\Http\Request;

class CryptoCurrenciesController extends Controller
{
    public function index($id) {
        $scriptJs = 'crypto.js';
        $crypto = GlobalData::findOrFail($id);
        $bitcoinPrice = GlobalData::find('bitcoin')->price_usd;
        $linkToIcon = "/img/icons/" . $crypto->id . ".png";
        return view('CryptoCurrencies.index',compact( 'scriptJs','crypto', 'bitcoinPrice', 'linkToIcon'));
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
