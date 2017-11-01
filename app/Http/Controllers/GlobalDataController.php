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

        $item = Search::find($input['id']);
        if($item != null) {
            $rate = $item->rate;
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
        } else {
            //need to create new;
            $search = new Search();
            $search->id = $input['id'];
            $search->type = $input['class'];
            $search->exchange2 = $input['exchange2'];
            $search->exchange1 = $input['exchange1'];
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
