<?php

namespace App\Http\Controllers;

use App\Cr_cc_profile;
use App\GlobalData;
use Request;

class WorldController extends Controller
{
    public function index() {
        $scriptJs = 'worldIndex.js';
        $money = Cr_cc_profile::all()->toArray();
        return view('World.index',compact( 'scriptJs', 'money'));
    }
    public function currency($id) {
        $id = str_replace('-exchange-rates','', $id);
        $id = str_replace('-', ' ', $id);
        $cc_profile = Cr_cc_profile::where('profile_long', $id)->get();
        $scriptJs = array("calculator.js", "worldCurrency.js");
        $bitcoinPrice = GlobalData::find('bitcoin')->price_usd;

        return view('World.currency',compact( 'scriptJs', 'cc_profile', 'bitcoinPrice'));
    }
}
