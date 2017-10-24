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
//        $db_array = array();
//        $item['id'] = 'USDEUR';
//        $item['rate'] = 1;
//        $item['type'] = 'exchange_pair';
//        $item['profile_long'] = '';
//        $item['exchange1'] = 'USD';
//        $item['exchange2'] = 'EUR';
//        $db_array[] = $item;
//
//
//        $gen_array = self::generateExchangePairUSD($fiats = Search::where('type', 'fiat')->orderBy('rate', 'DESC')->get()->toArray());
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
            ->orderBy('rate', 'DESC')->get()->toArray();
        return $fiat;
    }
    public static function getAllFiatValues() {
        return Search::where('type', 'fiat')->orderBy('rate', 'DESC')->get()->toArray();
    }

    public static function getAllCryptoValues() {
        return Search::where('type', 'crypto')->orderBy('rate', 'DESC')->get()->toArray();
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
            ->orderBy('rate', 'DESC')->get()->toArray();
        return $cryptoes;
    }

    public static function searchInPair($str)
    {
//      затем делаем пары из фиатных - фиатная валюта которая совпала по поиску + все фиаты
        $allFiat = self::getAllFiatValues();
        $searchFiat = self::searchInFiatValues($str);
        $fiat = self::mergeSearchWithAll($searchFiat, $allFiat);

        //теперь пары из крипто
        $allCrypto = self::getAllCryptoValues();
        $searchCrypto = self::searchInCryptoValues($str);
        $crypto = self::mergeSearchWithAll($searchCrypto, $allCrypto);

        //теперь надо оставить только уникальные пары
        //сначала отдаем пары по рейтингу, ищем только по exchange1
        $pairsExchange1 = Search::where('type', 'exchange_pair')->where('exchange1','like', '%' . $str. '%')->orderBy('rate', 'DESC')->get()->toArray();
        //$pairsExchange2 = Search::where('type', 'exchange_pair')->where('exchange2','like', '%' . $str. '%')->orderBy('rate', 'DESC')->get()->toArray(); //это в случе если необходимо искать  по второй паре
        $result = self::mergeFromDBandGenerated($pairsExchange1, array_merge($fiat, $crypto));
        $result = array_merge($result, $searchFiat);
        $result = array_merge($result, $searchCrypto);
        return $result;
    }

    public static function searchInListSearch($str)
    {
        /*
         * сначала отдаем пары по рейтингу, ищем только по exchange1
         * затем делаем пары из фиатных - фиатная валюта которая совпала по поиску + все фиаты
         * затем крипто пары - крипто которые совпали + все крипто
         * далее все фиатные совпали
         * далее все крипто которые совпали
         * */

        if (count($str) > 0) {
            return self::searchInPair($str);

//            $exchange_pairs = [];
//            $str = strtoupper($str);
//            $fiat = Search::where('type', 'fiat')->orderBy('rate', 'DESC')->get()->toArray();
//
//            foreach ($fiat as $item) {
//                $item['id'] = $str . $item['id'];
//                $item['type'] = "exchange_pair";
//                $item['exchange1'] = $str;
//                $item['exchange2'] = $item['id'];
//                $exchange_pairs[] = $item;
//            }
//
//            $crypto = Search::where('type', 'crypto')
//                ->orderBy('rate', 'DESC')->get()->toArray();
//
//            foreach ($crypto as $item) {
//                $item['id'] = $str . $item['id'];
//                $item['type'] = "exchange_pair";
//                $exchange_pairs[] = $item;
//            }
//                $cryptoes = Search::where('type', 'crypto')
//                    ->where('id', 'like', '%' . $str . '%')
//                    ->orderBy('rate', 'DESC')->get()->toArray();
//
//                $exchange_pairs = array_merge($exchange_pairs, $cryptoes);
//
//            $fiats = Search::where('type', 'fiat')
//                ->where('id', 'like', '%' . $str . '%')
//                ->orderBy('rate', 'DESC')->get()->toArray();
//
//
//            $exchange_pairs = array_merge($exchange_pairs, $fiats);
//            }
//            return $exchange_pairs;
        }
    }
}