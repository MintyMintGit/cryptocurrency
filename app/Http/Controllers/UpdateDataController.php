<?php

namespace App\Http\Controllers;

use App\ExchangeRate;
use App\CoinMarketCap;
use App\GlobalData;
use App\ExchangeRatesCap;
use App\Search;

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
        $data = CoinMarketCap\Base::getGlobalData();

        foreach ($data as $item) {


            GlobalData::updateOrCreate(
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
        $this->updateSearchTable();
        return 'Updated successfully';
    }
    /**
     * Store all data from the ExchangeRates
     *
     * @return Response
     */
    public function storeExchangeRates()
    {
        $data = ExchangeRatesCap\Base::getExchangeRates();
        foreach ($data['quotes'] as $key => $item) {
            if ($key != "USDBTC") {
                ExchangeRate::updateOrCreate(
                    [
                        'name_quotes' => $key
                    ],
                    [
                        'value_quotes' => $item,
                        'timestamp' => $data['timestamp'],
                        'source' => $data['source']
                    ]
                );
            }
        }
        $this->updateSearchTable();
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
    public static function updateSearchTable() {
        $listElements = Search\Base::generateListElements();
        foreach ($listElements as $listElement) {
            Search::updateOrCreate(
                [
                    'id' => "{$listElement['id']}"
                ],[
                    "price_usd" => $listElement['price_usd'],
                    "type" => $listElement['type'],
                    "profile_long" => $listElement['profile_long'],
                ]
            );
        }

    }
}
