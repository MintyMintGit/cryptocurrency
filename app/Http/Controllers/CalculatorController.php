<?php

namespace App\Http\Controllers;

use App\ExchangeRate;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public static function index() {
        $scriptJs = 'calculator.js';
        /*get list of currency  */
//        $exchange_rates = ExchangeRate::all()->toArray();
//        foreach ($exchange_rates as $item) {
//            $item = substr($item, 2);
//        }

        return view('Calculator.index', compact( 'scriptJs', 'exchange_rates'));
    }
    public function calc() {
        $a = 10;
        //POST['lin']
    }

}
