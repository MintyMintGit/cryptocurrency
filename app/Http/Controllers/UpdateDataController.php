<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\CoinMarketCap;
use App\GlobalData;

class UpdateDataController extends Controller
{
    /**
     * Store all data from the coinmarketcap
     *
     * @param  int $id
     * @return Response
     */
    public function storeAllFrom()
    {

//        $flight = GlobalData::updateOrCreate(
//            [
//                'id' => 'name222',
//            ],
//            [
//                'name' => "name1",
//                'symbol' => "123456",
//                'rank' => 1,
//                'price_usd' => 301.988,
//                'price_btc' => 0.0675865,
//                '24h_volume_usd' => 327982000.0,
//                'market_cap_usd' => 28568523357.0,
//                'available_supply' => 94915822.0,
//                'total_supply' => 94915822.0,
//                'percent_change_1h' => 0.23,
//                'percent_change_24h' => 3.28,
//                'percent_change_7d' => 17.46,
//                'last_updated' => '11111111111'
//                //2017-10-02 11:03:16
//            ]
//        );
        $base = new CoinMarketCap\Base();
        $data = $base->getGlobalData();

        foreach ($data as $key => $item) {


            $globalData = GlobalData::updateOrCreate(
                [
                    'id' => "{$item['id']}"
                ] ,
                [
                    'name' => "{$item['name']}",
                    'symbol' => "{$item['symbol']}",
                    'rank' => "{$item['rank']}",
                    'price_usd' => $this->updateValue($item['price_usd']),
                    'price_btc' => $this->updateValue($item['price_btc']),
                    'volume_usd_24h' => $this->updateValue($item['24h_volume_usd']),
                    'market_cap_usd' => $this->updateValue($item['market_cap_usd']),
                    'available_supply' => $this->updateValue($item['available_supply']),
                    'total_supply' => $this->updateValue($item['total_supply']),
                    'percent_change_1h' => $this->updateValue($item['percent_change_1h']),
                    'percent_change_24h' => $this->updateValue($item['percent_change_24h']),
                    'percent_change_7d' => $this->updateValue($item['percent_change_7d']),
                    'last_updated' => $this->updateValue($item['last_updated'])
                ]
            );
        }
        return 'Updated successfully';
    }
    function updateValue($number) {
        $value = rand(0,1) == 1;
        if($value) {
            $number = $number + ($number * 0.05 / 100);
        } else {
            $number = $number - ($number * 0.05 / 100);
        }
        return $number;
    }
}
