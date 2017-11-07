<?php

namespace App\Http\Controllers;

use App\Cr_cc_profile;
use App\ExchangeRate;
use App\GlobalData;
use App\Search;
use Request;

class CalculatorController extends Controller
{
    public function calc()
    {
        $CloudsOfCurrencies = Search::getCloudsOfCurrencies();
        $from = "";
        $to = "";
        /*check is contains crypto in links*/
        $position = strpos($_SERVER['REDIRECT_URL'], '-');
        if ($position > 0) {
            $links = $this->cutUrlIndex($_SERVER['REDIRECT_URL'], $position);
            $position = strpos($links, '-');
            if ($position > 0) {
                $links = explode('-', $links);
                if (count($links) > 0) {
                    $from = $this->findISOFullName($links[0]);
                    $to = $this->findISOFullName($links[1]);
                }
            }
        }
        $scriptJs = 'convertor.js';
        $bitcoin = GlobalData::find('bitcoin');
        $bitcoinDateUpdate = $bitcoin->last_updated;
        $bitcoinPrice = $bitcoin->price_usd;
        $harcodedEur = "0.861602";
        return view('Calculator.converter', compact('scriptJs', 'bitcoinPrice', 'CloudsOfCurrencies', 'bitcoinDateUpdate', 'harcodedEur', 'to', 'from'));
    }

    private function cutUrlIndex($str, $index)
    {
        return substr($str, $index - 3);
    }

    private function findISOFullName($iso)
    {
        $searchResult = $this->findInCrypto($iso);
        if ($searchResult) {
            return $searchResult;
        }
        return $this->findInFiat($iso);
    }

    private function findInCrypto($iso)
    {
        $temp = GlobalData::where('symbol', 'like', $iso)->first();
        if ($temp) {
            return $temp->name;
        }
        return null;
    }

    private function findInFiat($iso)
    {
        $temp = Cr_cc_profile::where('profile_short', 'like', $iso)->first();
        if ($temp) {
            return $temp->profile_long;
        }
        return null;
    }
}
