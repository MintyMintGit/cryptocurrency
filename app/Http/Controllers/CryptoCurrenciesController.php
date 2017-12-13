<?php

namespace App\Http\Controllers;

use App\GlobalData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CryptoCurrenciesController extends Controller
{
    public function index($id) {
        $scriptJs = 'crypto.js';
        $crypto = GlobalData::findOrFail($id);
        $bitcoinPrice = GlobalData::find('bitcoin')->price_usd;
        $linkToIcon = "/img/icons/" . $crypto->id . ".png";
        $social = DB::select("select * from crypto_sidebar where Symbol like ?", [$crypto->symbol]);
        $charts = true;
        $title = $crypto->name . "/" . $crypto->symbol ." Price (Digital Asset) &mdash; How To Buy " . $crypto->name;
        $description = $crypto->name . " price in United States Dollar and Euro. View charts, market cap, volume, social, and more.";

        return view('CryptoCurrencies.index',compact( 'scriptJs', 'crypto',
            'bitcoinPrice', 'linkToIcon', 'social' , 'charts', 'title', 'description'));
    }
}
