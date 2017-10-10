<?php

namespace App\Http\Controllers;

use App\ExchangeRate;
use App\GlobalData;
use Request;

class CalculatorController extends Controller
{
    public static function index() {
        $scriptJs = 'calculator.js';
        $bitcoinPrice = GlobalData::find('bitcoin')->price_usd;
        return view('Calculator.index', compact( 'scriptJs', 'bitcoinPrice'));
    }
    public function calc() {
        $scriptJs = 'convertor.js';
        $bitcoinPrice = GlobalData::find('bitcoin')->price_usd;
        return view('Calculator.converter',compact( 'scriptJs','bitcoinPrice'));
    }

}
