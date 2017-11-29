<?php

namespace App\Http\Controllers;

use App\Cr_cc_profile;
use App\GlobalData;
use App\ExchangeRate;
use Request;

class WorldController extends Controller
{
    public function index()
    {
        $scriptJs = 'worldindex.js';
        $money = Cr_cc_profile::all()->toArray();
        return view('World.index', compact('scriptJs', 'money'));
    }

    public function currency($id)
    {
        $id = str_replace('-exchange-rates', '', $id);
        $id = str_replace('-', ' ', $id);
        $cc_profile = Cr_cc_profile::where('profile_long', $id)->get();
        $scriptJs = array("calculator.js", "worldcurrency.js");
        $bitcoinPrice = GlobalData::find('bitcoin')->price_usd;
        $topTenCrypto = GlobalData::orderBy('market_cap_usd', 'DESC')->take(10)->get()->toArray();
        $moneyFiat = Cr_cc_profile::all()->toArray();
        foreach ($moneyFiat as $key => $fiat) {
            if ($fiat['profile_short'] == 'USD') {
                $moneyFiat[$key]['value_quotes'] = 1;
            } else {
                $value_quotes = ExchangeRate::where('name_quotes', 'like', 'USD' . $fiat['profile_short'])->select('value_quotes')->first();
                $moneyFiat[$key]['value_quotes'] = isset($value_quotes->value_quotes) ? $value_quotes->value_quotes : '';
            }
        }
        return view('World.currency', compact('scriptJs', 'cc_profile', 'bitcoinPrice', 'topTenCrypto', 'moneyFiat'));
    }
}
