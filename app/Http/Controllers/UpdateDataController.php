<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CoinMarketCap;

class UpdateDataController extends Controller
{
    /**
     * Store all data from the coinmarketcap
     *
     * @param  int  $id
     * @return Response
     */
    public function storeAllFrom()
    {
        $base = new CoinMarketCap\Base();
        $data = $base->getGlobalData();

        //return __DIR__.'/../vendor/autoload.php';
        $a = 10;

    }
}
