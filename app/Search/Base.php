<?php

namespace App\Search;

use App\Cr_cc_profile;
use App\ExchangeRate;
use App\GlobalData;
use App\Search;

class Base
{

    public static function generateFiatExchange()
    {
        $fiatCurrency = array();
        $fiatValues = ExchangeRate::all()->toArray();
        foreach ($fiatValues as $index => $fiatValue) {
            $name = str_replace("USD", "", $fiatValue['name_quotes']);
            if ($name == "") {
                $name = "USD";
            }
            $profile_long = Cr_cc_profile::where('profile_short', 'like', $name)->get();

            if ($profile_long->isEmpty()) {
                $profile_long = array();
                $profile_long[0]['profile_long'] = "";
            }
            $fiatCurrency[] = [
                'id' => $name,
                'price_usd' => $fiatValue['value_quotes'],
                'type' => 'fiat',
                'profile_long' => $profile_long[0]['profile_long']
            ];
        }
        return $fiatCurrency;
    }

    public static function generateCryptoExchange()
    {
        $cryptoCurrency = array();
        $cryptoGlobalData = GlobalData::all()->toArray();
        foreach ($cryptoGlobalData as $index => $cryptoGlobalDatum) {
            $cryptoGlobalDatum['type'] = 'crypto';
            $cryptoGlobalDatum['profile_long'] = $cryptoGlobalDatum['name'];
            $cryptoGlobalDatum['id'] = $cryptoGlobalDatum['symbol'];
            $cryptoCurrency[] = $cryptoGlobalDatum;
        }
        return $cryptoCurrency;
    }


    public static function generateListElements()
    {
        $exchange_pairs = array();
        $exchange_pairs = array_merge($exchange_pairs, self::generateFiatExchange());
        $exchange_pairs = array_merge($exchange_pairs, self::generateCryptoExchange());

        return $exchange_pairs;
    }


    public static function getFullListSearch()
    {
        $cryptoes = Search::where('type', 'crypto')->orderBy('rate', 'DESC')->get()->toArray();
        $fiats = Search::where('type', 'fiat')->orderBy('rate', 'DESC')->get()->toArray();


        $pairs = Search::where('type', 'exchange_pair')->where('exchange1','USD')->orderBy('rate', 'DESC')->get()->toArray();
        $exchange_pairs = array();
        $exchange_pairs = array_merge($exchange_pairs, self::generateExchangePair($fiats));
        $exchange_pairs = array_merge($exchange_pairs, self::generateExchangePair($cryptoes));

        $exchange_pairs = self::mergeFromDBandGenerated($pairs, $exchange_pairs);

        $exchange_pairs = array_merge($exchange_pairs, $fiats);
        $exchange_pairs = array_merge($exchange_pairs, $cryptoes);

        return $exchange_pairs;
    }

    public static function generateExchangePair($exchange_array, $exchange = 'USD')
    {
        $exchange_pairs = array();
        foreach ($exchange_array as $item) {
            $item['type'] = 'exchange_pair';
            $item['exchange2'] = $item['id'];
            $item['exchange1'] = $exchange;
            $item['id'] = $exchange . $item['id'];
            $exchange_pairs[] = $item;
        }
        return $exchange_pairs;
    }
    public static function mergeFromDBandGenerated($db_array, $gen_array) {

        if(count($db_array) && count($gen_array)) {
            foreach ($gen_array as $i => $gen) {
                $flag = true;
                foreach ($db_array as $j => $db) {
                    if ($gen['id'] == $db['id']) {
                        $flag = false;
                    }
                }
                if($flag) {
                    $gen_array[$i]['profile_long'] = '';
                    $db_array[] = $gen_array[$i];
                }
            }
            return $db_array;
        } else if (count($db_array == 0)) {
            return $gen_array;
        } else {
            return $db_array;
        }
    }

    public static function searchInFiatValues($str)
    {
        $fiat = Search::where('type', 'fiat')
            ->where('id', 'like', '%' . $str . '%')
            ->orderBy('rate', 'DESC')->take(2)->get()->toArray();
        return $fiat;
    }
    public static function getAllFiatValues() {
        return Search::where('type', 'fiat')->orderBy('rate', 'DESC')->take(2)->get()->toArray();
    }

    public static function getAllCryptoValues() {
        return Search::where('type', 'crypto')->orderBy('rate', 'DESC')->take(2)->get()->toArray();
    }

    public static function mergeSearchWithAll($search_array, $search_all) {
        $result = [];
        foreach ($search_array as $i => $search_item) {
            foreach ($search_all as $j => $all_item) {
                $temp = array();
                $temp['id'] = $search_item['id'] . $all_item['id'];
                $temp['exchange1'] = $search_item['id'];
                $temp['exchange2'] = $all_item['id'];
                $temp['profile_long'] = '';
                $temp['type'] = 'exchange_pair';
                $temp['price_usd'] = 0;
                $result[] = $temp;
            }
        }
        return $result;
    }

    public static function searchInCryptoValues($str)
    {
        $cryptoes = Search::where('type', 'fiat')
            ->where('id', 'like', '%' . $str . '%')
            ->orderBy('rate', 'DESC')->take(2)->get()->toArray();
        return $cryptoes;
    }

    public static function searchInPair($str)
    {
        $allFiat = self::getAllFiatValues();
        $searchFiat = self::searchInFiatValues($str);
        $fiat = self::mergeSearchWithAll($searchFiat, $allFiat);

        $allCrypto = self::getAllCryptoValues();
        $searchCrypto = self::searchInCryptoValues($str);
        $crypto = self::mergeSearchWithAll($searchCrypto, $allCrypto);

        $pairsExchange1 = Search::where('type', 'exchange_pair')->where('exchange1','like', '%' . $str. '%')->orderBy('rate', 'DESC')->get()->toArray();
        $result = self::mergeFromDBandGenerated($pairsExchange1, array_merge($fiat, $crypto));
        $result = array_merge($result, $searchFiat);
        $result = array_merge($result, $searchCrypto);
        return $result;
    }

    public static function searchInListSearch($str)
    {
        if (count($str) > 0) {
            return self::searchInPair($str);
        }
    }
}