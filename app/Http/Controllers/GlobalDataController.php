<?php

namespace App\Http\Controllers;

use App\GlobalData;
use App\Search;
use Request;

class GlobalDataController extends Controller
{
    public function index()
    {
        $CloudsOfCurrencies = Search::getCloudsOfCurrencies();
        $bitcoinPrice = GlobalData::findOrFail('bitcoin')->price_usd;
        $ethPrice = GlobalData::findOrFail('ethereum')->price_usd;
        $scriptJs = array("globalData.js", "calculator.js");
        return view('globalData.index', compact('bitcoinPrice', 'ethPrice', 'scriptJs', 'CloudsOfCurrencies'));
    }
    public function saveStatistic()
    {
        $input = Request::all();
        $rate = Search::find($input['id'])->rate;
        if($rate >= 0) {
            $rate++;
            Search::where('id', $input['id'])->update(array('rate' => $rate));
        } else if($rate['class'] == 'fiat') {
            $search = new Search();
            $search->id = $input['id'];
            $search->type = $input['fiat'];
            $search->rate = 1;
            $search->save();
        }
    }
    public function crypto()
    {
        $allCrypto = GlobalData::all();
        $scriptJs = "allCrypto.js";
        return view('globalData.crypto', compact('allCrypto', 'scriptJs'));
    }
}
