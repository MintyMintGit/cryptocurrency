<?php

namespace App\Http\Controllers;

use App\GlobalData;
use Illuminate\Http\Request;

class GlobalDataController extends Controller
{
    public function index()
    {
        $bitcoinPrice = GlobalData::findOrFail('bitcoin')->price_usd;
        $ethPrice = GlobalData::findOrFail('ethereum')->price_usd;
        $scriptJs = array("globalData.js", "calculator.js");
        return view('globalData.index', compact('bitcoinPrice', 'ethPrice', 'scriptJs'));
    }
}
