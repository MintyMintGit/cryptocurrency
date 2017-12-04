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
        $canonical = $_SERVER['APP_URL']. '/calculator/' .$this->currencyFrom->shortName. '-' . $this->currencyTo->shortName . '?1';
        return view('Calculator.converter', compact('scriptJs', 'bitcoinPrice', 'CloudsOfCurrencies', 'bitcoinDateUpdate','to', 'from', 'canonical'))
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
        if ($this->currencyTo->fullName == null || $this->currencyFrom->fullName == null) {
            /*set default params*/
            $this->currencyFrom = Currency::setDefaultValueFrom();
            $this->currencyTo = Currency::setDefaultValueTo();
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
            $currency->crypto = false;
        }
        return $currency;
    }

}
