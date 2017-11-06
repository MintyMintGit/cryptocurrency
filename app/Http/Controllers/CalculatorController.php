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
        /*check is contains crypto in links*/
        $position = strpos($_SERVER['REDIRECT_URL'], '-');
        if ($position > 0) {
            $links = $this->cutUrlIndex($_SERVER['REDIRECT_URL'], $position);
            $position = strpos($links, '-');
            if ($position > 0) {
                $links = explode('-', $links);
                if (count($links) > 0) {
                    $from = Cr_cc_profile::where('profile_short', 'like', $links[0])->get();
                    $to = = Cr_cc_profile::where('profile_short', 'like', $links[0])->get();
                    SELECT * FROM `cr_cc_profiles` WHERE `profile_short` LIKE 'USD'
                }
            }
        }
        $scriptJs = 'convertor.js';
        $bitcoin = GlobalData::find('bitcoin');
        $bitcoinDateUpdate = $bitcoin->last_updated;
        $bitcoinPrice = $bitcoin->price_usd;
        $harcodedEur = "0.861602";
        return view('Calculator.converter', compact('scriptJs', 'bitcoinPrice', 'CloudsOfCurrencies', 'bitcoinDateUpdate', 'harcodedEur'));
    }

    private function cutUrlIndex($str, $index)
    {
        return substr($str, $index - 3);
    }

    private function findISOFullName($iso)
    {
        $searchResult = findInCrypto($iso);
        if(findInCrypto)
    }
    private function findInCrypto($iso)
    {
        return GlobalData::find($iso)->get();
    }
    private function findInFiat($iso)
    {

    }
}
