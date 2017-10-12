<?php

namespace App\Search;

use App\ExchangeRate;
use App\GlobalData;
use App\Search;

class Base
{
    public static function generateListElements()
    {
        $fiatСurrency = [];
        $exchange_pairs = ExchangeRate::all()->toArray();
        foreach ($exchange_pairs as $key => $exchange_pair) {

            $exchange_pairs[$key]['type'] = 'exchange_pair';
            $exchange_pairs[$key]['name'] = $exchange_pairs[$key]['name_quotes'];
            $exchange_pairs[$key]['price_usd'] = $exchange_pairs[$key]['value_quotes'];

            $fiatСurrency[] = [
                'name' => str_replace("USD", "", $exchange_pair['name_quotes']),
                'price_usd' => $exchange_pair['value_quotes'],
                'type' => 'fiat'
            ];
        }
        $cryptoCurrency = array();
        $cryptoGlobalData = GlobalData::all()->toArray();

        foreach ($cryptoGlobalData as $key => $item) {

            $item['name'] = "USD" . $item['symbol'];
            $item['type'] = 'exchange_pair';
            $exchange_pairs[] = $item;

            $cryptoGlobalData[$key]['type'] = 'crypto';
            $cryptoCurrency[] = $cryptoGlobalData[$key];
        }
        $exchange_pairs = array_merge($exchange_pairs, $fiatСurrency);
        $exchange_pairs = array_merge($exchange_pairs, $cryptoCurrency);
        return $exchange_pairs;
//SELECT * FROM searches WHERE `searches`.`id` = ''
    }

    public static function getFullListSearch() {

        $exchange_pairs = Search::where('type', 'exchange_pair')->orderBy('rate', 'DESC')->get()->toArray();

        $cryptoes = Search::where('type', 'crypto')->orderBy('rate', 'DESC')->get()->toArray();
        $exchange_pairs = array_merge($exchange_pairs,$cryptoes);

        $fiats = Search::where('type', 'fiat')->orderBy('rate', 'DESC')->get()->toArray();
        $exchange_pairs = array_merge($exchange_pairs,$fiats);
        return $exchange_pairs;
    }

    public static function searchInListSearch($str) {
        if(count($str) > 0) {

            $exchange_pairs = Search::where('type', 'exchange_pair')
                ->where('id', 'like', '%'.$str.'%')
                ->orderBy('rate', 'DESC')->get()->toArray();

            $cryptoes = Search::where('type', 'crypto')
                ->where('id', 'like', '%'.$str.'%')
                ->orderBy('rate', 'DESC')->get()->toArray();


            $exchange_pairs = array_merge($exchange_pairs,$cryptoes);

            $fiats = Search::where('type', 'fiat')
                ->where('id', 'like', '%'.$str.'%')
                ->orderBy('rate', 'DESC')->get()->toArray();


            $exchange_pairs = array_merge($exchange_pairs,$fiats);
            return $exchange_pairs;
        }
    }
}