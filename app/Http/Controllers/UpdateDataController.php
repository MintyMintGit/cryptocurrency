<?php

namespace App\Http\Controllers;

use App\ExchangeRate;
use App\CoinMarketCap;
use App\GlobalData;
use App\ExchangeRatesCap;
use App\Search;
use App\TotalMarketCap;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
        $TotalMarketCap = 0;
        foreach ($data as $key => $item) {
            $TotalMarketCap += $item['market_cap_usd'];
            $oldItem = GlobalData::find($item['id']);
            if($oldItem == null) {
                $newItem = new GlobalData;
                $newItem->id = $item['id'];
                $newItem->name = $item['name'];
                $newItem->symbol = $item['symbol'];
                $newItem->rank = $item['rank'];
                $newItem->price_usd = $item['price_usd'];
                $newItem->price_btc = $item['price_btc'];
                $newItem->volume_usd_24h = $item['24h_volume_usd'];
                $newItem->market_cap_usd = $item['market_cap_usd'];
                $newItem->available_supply = $item['available_supply'];
                $newItem->total_supply = $item['total_supply'];
                $newItem->percent_change_1h = $item['percent_change_1h'];
                $newItem->percent_change_24h = $item['percent_change_24h'];
                $newItem->percent_change_7d = $item['percent_change_7d'];
                $newItem->last_updated = $item['last_updated'];
                $newItem->price_usdOld = $item['price_usd'];
                $newItem = $this->checkGlobalData($newItem);
                $newItem->save();
            } else {
                $oldItem->name = $item['name'];
                $oldItem->symbol = $item['symbol'];
                $oldItem->rank = $item['rank'];
                $oldItem->price_usdOld = $oldItem->price_usd;
                $oldItem->price_usd = $item['price_usd'];
                $oldItem->price_btc = $item['price_btc'];
                $oldItem->volume_usd_24h = $item['24h_volume_usd'];
                $oldItem->market_cap_usd = $item['market_cap_usd'];
                $oldItem->available_supply = $item['available_supply'];
                $oldItem->total_supply = $item['total_supply'];
                $oldItem->percent_change_1h = $item['percent_change_1h'];
                $oldItem->percent_change_24h = $item['percent_change_24h'];
                $oldItem->percent_change_7d = $item['percent_change_7d'];
                $oldItem->last_updated = $item['last_updated'];
                $oldItem = $this->checkGlobalData($oldItem);
                $oldItem->save();
            }


            /*GlobalData::updateOrCreate(
                ['id' => "{$item['id']}"],
                ['name' => "{$item['name']}",
                'symbol' => "{$item['symbol']}", 'rank' => "{$item['rank']}",
                    'price_usd' => $this->updateValue($item['price_usd']),
                    'price_btc' => $this->updateValue($item['price_btc']),
                    'volume_usd_24h' => $this->updateValue($item['24h_volume_usd']),
                    'market_cap_usd' => $this->updateValue($item['market_cap_usd']),
                    'available_supply' => $this->updateValue($item['available_supply']),
                    'total_supply' => $this->updateValue($item['total_supply']),
                    'percent_change_1h' => $this->updateValue($item['percent_change_1h']),
                    'percent_change_24h' => $this->updateValue($item['percent_change_24h']),
                    'percent_change_7d' => $this->updateValue($item['percent_change_7d']),
                    'last_updated' => $this->updateValue($item['last_updated'])]);*/



            $tableName = str_replace(' ', '-', $item['id']);
            if (!Schema::connection('mysql2')->hasTable($tableName)) {
                $tableName = str_replace(' ', '-', $item['name']);
                if (!Schema::connection('mysql2')->hasTable($tableName)) {
                    try {
                        $tableName = str_replace(' ', '-', $item['id']);
                        $this->tryCreateTable($tableName);
                    } catch (\Illuminate\Database\QueryException $e) {
                        $tableName = str_replace(' ', '-', $item['name']);
                        $this->tryCreateTable($tableName);
                    } catch (PDOException $e) {
                        dd($e);
                    }
                }
            }
            $item = $this->checkGlobalDataForItemAPI($item);
            $this->insertToHistoryDB($tableName, $item);
        }
        TotalMarketCap::updateOrCreate(['id' => 1 ], ['price' => $TotalMarketCap]);
        $this->updateSearchTable();
        return 'Updated successfully';
    }
    /**
     * Store all data from the ExchangeRates
     *
     * @return Response
     */
    public static function storeExchangeRates()
    {
        $data = ExchangeRatesCap\Base::getExchangeRates();
        foreach ($data['quotes'] as $key => $item) {
            if ($key != "USDBTC") {

                $oldItem = ExchangeRate::where('name_quotes', 'like', $key)->get()->first();
                if ($oldItem === null) {
                    $exchange = new ExchangeRate;

                    $exchange->name_quotes = $key;
                    $exchange->value_quotes = $item;
                    $exchange->value_quotesOld = $item;
                    $exchange->source = $data['source'];
                    $exchange->timestamp = \Carbon\Carbon::now();
                    $exchange->save();

                    //need to creqate new one;
                } else {
                    //need to get old value_quotes an put to value_quotesOld
                    //put new value_quotes
                    $oldItem->value_quotesOld = $oldItem->value_quotes;
                    $oldItem->value_quotes = $item;
                    $oldItem->source = $data['source'];
                    $oldItem->timestamp = \Carbon\Carbon::now();
                    $oldItem->save();
                }
            }
        }
        self::updateSearchTable();
        self::updateCssImg();
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
    function tryCreateTable($tableName) {
        Schema::connection('mysql2')->create(quotemeta($tableName), function ($table) {
            $table->increments('id');
            $table->double('price_usd');
            $table->dateTime('created_at');
        });
        return true;
    }

    function insertToHistoryDB($tableName, $data)
    {
        DB::connection('mysql2')->table(quotemeta($tableName))->insert(['price_usd' => $data['price_usd'], 'created_at' => Carbon::now()]);
    }
    function checkGlobalData($item)
    {
        $item['price_usd'] = $item['price_usd']==null ? 0 :$item['price_usd'];
        $item['price_btc'] = $item['price_btc']==null ? 0 :$item['price_btc'];
        $item['volume_usd_24h'] = $item['volume_usd_24h']==null ? 0 :$item['volume_usd_24h'];
        $item['market_cap_usd'] = $item['market_cap_usd']==null ? 0 :$item['market_cap_usd'];
        $item['available_supply'] = $item['available_supply']==null ? 0 :$item['available_supply'];
        $item['total_supply'] = $item['total_supply']==null ? 0 :$item['total_supply'];
        $item['percent_change_1h'] = $item['percent_change_1h']==null ? 0 :$item['percent_change_1h'];
        $item['percent_change_24h'] = $item['percent_change_24h']==null ? 0 :$item['percent_change_24h'];
        $item['percent_change_7d'] = $item['percent_change_7d']==null ? 0 :$item['percent_change_7d'];
        $item['last_updated'] = $item['last_updated']==null ? 0 :$item['last_updated'];
        return $item;
    }
    function checkGlobalDataForItemAPI($item)
    {
        $item['price_usd'] = $item['price_usd']==null ? 0 :$item['price_usd'];
        $item['price_btc'] = $item['price_btc']==null ? 0 :$item['price_btc'];
        $item['volume_usd_24h'] = $item['24h_volume_usd']==null ? 0 :$item['24h_volume_usd'];
        $item['market_cap_usd'] = $item['market_cap_usd']==null ? 0 :$item['market_cap_usd'];
        $item['available_supply'] = $item['available_supply']==null ? 0 :$item['available_supply'];
        $item['total_supply'] = $item['total_supply']==null ? 0 :$item['total_supply'];
        $item['percent_change_1h'] = $item['percent_change_1h']==null ? 0 :$item['percent_change_1h'];
        $item['percent_change_24h'] = $item['percent_change_24h']==null ? 0 :$item['percent_change_24h'];
        $item['percent_change_7d'] = $item['percent_change_7d']==null ? 0 :$item['percent_change_7d'];
        $item['last_updated'] = $item['last_updated']==null ? 0 :$item['last_updated'];
        return $item;
    }

    static function updateCssImg() {
        $returned_content = self::get_data('https://coinmarketcap.com/static/sprites/all_views_all_0.css');
        if($returned_content != null) {
            $file = $_SERVER['DOCUMENT_ROOT'] . '/css' . '/cryptoIcons.css';
            file_put_contents($file, $returned_content);
        }
        $returned_content = self::get_data('https://coinmarketcap.com/static/sprites/all_views_all_0.png');
        if($returned_content != null) {
            $file = $_SERVER['DOCUMENT_ROOT'] . '/css' . '/all_views_all_0.png';
            file_put_contents($file, $returned_content);
        }
    }
    static function get_data($url) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
