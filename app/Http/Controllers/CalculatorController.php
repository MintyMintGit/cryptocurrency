<?php

namespace App\Http\Controllers;

use App\Cr_cc_profile;
use App\Currency;
use App\ExchangeRate;
use App\GlobalData;
use App\Search;
use Request;

class CalculatorController extends Controller
{
    private $currencyFrom;
    private $currencyTo;
    private $amount;
    private $arrayConversionTable = [1, 10, 20, 25, 30, 50, 100, 250, 500, 1000, 2000];

    function __construct()
    {
        $this->currencyFrom = new Currency();
        $this->currencyTo = new Currency();
    }

    public function calc()
    {
        $this->amount = 1;
        $CloudsOfCurrencies = Search::getCloudsOfCurrencies();
        $this->getFromToAmountFromString($_SERVER['REQUEST_URI']);
        $scriptJs = 'convertor.js';
        $bitcoin = GlobalData::find('bitcoin');
        $bitcoinDateUpdate = $bitcoin->last_updated;
        $bitcoinPrice = $bitcoin->price_usd;
        $to = 'usd';
        $from = 'eur';
        /*show conversion table*/
        $showConversionTable = true;
        if ($this->currencyTo->fullName == null || $this->currencyFrom->fullName == null) {
            $canonical = $_SERVER['APP_URL']. '/calculator';
            $this->currencyFrom = Currency::setDefaultValueFrom();
            $this->currencyTo = Currency::setDefaultValueTo();
            /*disable conversion table*/
            $showConversionTable = false;
        } else {
            $canonical = $_SERVER['APP_URL'] . '/calculator/' . $this->currencyFrom->shortName . '-' . $this->currencyTo->shortName . '?1';
        }

        if ($this->currencyTo->crypto == true) {
            $conversionTable = $this->getEachConversionCrypto(1 / $this->currencyTo->price_usd, $this->currencyFrom->price_usd);
        } else if ($this->currencyFrom->crypto == true) {
            $conversionTable = $this->getEachConversionCrypto($this->currencyTo->price_usd, 1 / $this->currencyFrom->price_usd);
        } else {
            $conversionTable = $this->getEachConversionFiat($this->currencyTo->price_usd, $this->currencyFrom->price_usd);
        }
        return view('Calculator.converter', compact('scriptJs', 'bitcoinPrice', 'CloudsOfCurrencies', 'bitcoinDateUpdate','to', 'from', 'canonical', 'conversionTable', 'showConversionTable'))
            ->with('amount', $this->amount)
            ->with('currencyTo', $this->currencyTo)
            ->with('currencyFrom', $this->currencyFrom);
    }

    /*
     * get Amount, From, To param from string
     * return array of values
     *
     * */

    private function getFromToAmountFromString($url)
    {
        $this->getFromToFromString($url);
        if ($this->currencyFrom->shortName != null && $this->currencyTo->shortName != null) {
            $this->currencyFrom = $this->updateCurrency($this->currencyFrom);
            $this->currencyTo = $this->updateCurrency($this->currencyTo);
            $this->getAmountFromString($url);
        }

    }

    private function getFromToFromString($url)
    {
        /*check is contains crypto in links*/
        $url = strtolower($url);
        $position = strpos($url, '-');
        if ($position > 0) {
            $arrayExp = explode('/', $url);
            foreach ($arrayExp as $expl) {
                if (strpos($expl, '-') > 0) {
                    $links = explode('?', $expl);
                    foreach ($links as $link) {
                        if(strpos($link, '-') > 0) {
                            $arrayCurrencies = explode('-', $link);
                            $this->currencyFrom->shortName = $arrayCurrencies[0];
                            $this->currencyTo->shortName = $arrayCurrencies[1];
                        }
                    }
                }
            }
        }
    }

    private function getAmountFromString($url)
    {
        $position = strpos($url, '?');
        if ($position > 0) {
            $amountString = mb_substr($url, $position + 1);
            if ($amountString != null) {
                try {
                    $this->amount = intval($amountString);
                } catch (\Exception $e) {
                    $this->amount = 1;
                }
            }
        } else {
            $this->amount = 1;
        }
    }

    private function updateCurrency($currency)
    {
        $currency->fullName = Currency::searchFiatFullNameByISO($currency->shortName);
        if ($currency->fullName == null) {
            $currency->fullName = Currency::searchCryptoNameByISO($currency->shortName);
            if ($currency->fullName == null) {
                //set default value
                $currency = Currency::setDefaultValueFrom();
            } else {
                $currency->price_usd = Currency::searchCryptoPriceByISO($currency->shortName);
                $currency->crypto = true;
            }
        } else {
            $currency->price_usd = Currency::searchFiatPriceByISO($currency->shortName);
            $currency->symbol = Cr_cc_profile::where('profile_short', 'like', $currency->shortName)->get();
            if (isset($currency->symbol[0]->profile_symbol)) {
                $currency->symbol = $currency->symbol[0]->profile_symbol;
            } else {
                $currency->symbol = null;
            }
            $currency->crypto = false;
        }
        return $currency;
    }
    private function convertCrypto($amount, $priceUsdTo, $priceUsdFrom)
    {
        return number_format((float) $amount * ($priceUsdTo / $priceUsdFrom), 2, '.', '');
    }
    private function convertAmountCrypto($result, $priceUsdTo, $priceUsdFrom)
    {
        return number_format((float) $result / ($priceUsdTo / $priceUsdFrom), 2, '.', '');
    }
    private function convertFiat($amount, $priceUsdTo, $priceUsdFrom)
    {
        return number_format((float) $amount * $priceUsdTo / $priceUsdFrom, 2, '.', '');
    }
    private function convertAmount($result, $priceUsdTo, $priceUsdFrom)
    {
        return number_format((float) $result * $priceUsdFrom / $priceUsdTo , 2, '.', '');
    }
    private function makeItemConversionTableFiat($amount, $priceUsdTo, $priceUsdFrom)
    {
        return array($amount, $this->convertFiat($amount, $priceUsdTo, $priceUsdFrom), $this->convertAmount($amount, $priceUsdTo, $priceUsdFrom));
    }
    private function makeItemConversionTableCrypto($amount, $priceUsdTo, $priceUsdFrom)
    {
        return array($amount, $this->convertCrypto($amount, $priceUsdTo, $priceUsdFrom), $this->convertAmountCrypto($amount, $priceUsdTo, $priceUsdFrom));
    }
    private function getEachConversionFiat($priceUsdTo, $priceUsdFrom)
    {
        $conversionTable = array();
        foreach ($this->arrayConversionTable as $index => $item) {
            array_push($conversionTable, $this->makeItemConversionTableFiat($item, $priceUsdTo, $priceUsdFrom));
        }
        return $conversionTable;
    }
    private function getEachConversionCrypto($priceUsdTo, $priceUsdFrom)
    {
        $conversionTable = array();
        foreach ($this->arrayConversionTable as $index => $item) {
            array_push($conversionTable, $this->makeItemConversionTableCrypto($item, $priceUsdTo, $priceUsdFrom));
        }
        return $conversionTable;
    }
}
