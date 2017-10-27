<?php

namespace App\Http\Controllers;

use App\ExchangeRate;
use App\GlobalData;
use App\Search;
use Request;

class CalculatorController extends Controller
{
    public function calc() {
        $CloudsOfCurrencies = Search::getCloudsOfCurrencies();
        $scriptJs = 'convertor.js';
        $bitcoinPrice = GlobalData::find('bitcoin')->price_usd;
        return view('Calculator.converter',compact( 'scriptJs','bitcoinPrice', 'CloudsOfCurrencies' ));
    }
}
