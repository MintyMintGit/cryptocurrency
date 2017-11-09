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
        $CloudsOfCurrencies = Search::getCloudsOfCurrencies();
        $this->getFromToAmountFromString($_SERVER['REQUEST_URI']);
        $scriptJs = 'convertor.js';
        $bitcoin = GlobalData::find('bitcoin');
        $bitcoinDateUpdate = $bitcoin->last_updated;
        $bitcoinPrice = $bitcoin->price_usd;
        $to = 'usd';
        $from = 'eur';

        return view('Calculator.converter', compact('scriptJs', 'bitcoinPrice', 'CloudsOfCurrencies', 'bitcoinDateUpdate','to', 'from'))
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
            $temp['amount'] = $this->getAmountFromString($url);
        }
    }

    private function getFromToFromString($url)
    {
        /*check is contains crypto in links*/
        $position = strpos($url, '-');
        if ($position > 0) {
            $links = substr($url, $position - 3);
            $position = strpos($links, '-');
            if ($position > 0) {
                $links = explode('-', $links);
                if (count($links) > 0) {
                    if (strpos($links[1], '?') > 0) {
                        $amount = strpos($links[1], '?');
                        $links[1] = mb_substr($links[1], 0, $amount);
                    }
                    $this->currencyFrom->shortName = $links[0];
                    $this->currencyTo->shortName = $links[1];
                }
            }
        } else {
            /*set default params*/
            $this->currencyFrom = Currency::setDefaultValueFrom();
            $this->currencyTo = Currency::setDefaultValueTo();
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
                $currency->isCrypto = true;
            }
        } else {
            $currency->price_usd = Currency::searchFiatPriceByISO($currency->shortName);
            $currency->isCrypto = false;
        }
        return $currency;
    }

}
