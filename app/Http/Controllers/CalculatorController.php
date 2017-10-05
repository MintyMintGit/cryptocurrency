<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public static function index() {
        $scriptJs = 'calculator.js';
        return view('Calculator.index', compact( 'scriptJs'));
    }
    public function calc() {
        $a = 10;
        //POST['lin']
    }

}
