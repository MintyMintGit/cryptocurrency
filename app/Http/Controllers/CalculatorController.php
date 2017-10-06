<?php

namespace App\Http\Controllers;

use App\ExchangeRate;
use App\GlobalData;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public static function index() {
        $scriptJs = 'calculator.js';
        $bitcoinPrice = GlobalData::find('bitcoin')->get(['price_usd']);
        return view('Calculator.index', compact( 'scriptJs', 'bitcoinPrice'));
    }
    public function calc() {
        $scriptJs = 'converter.js';
        return view('Calculator.converter',compact( 'scriptJs', 'exchange_rates'));
    }

}
