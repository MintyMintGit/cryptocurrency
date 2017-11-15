<?php
/**
 * Created by PhpStorm.
 * User: mmpc1
 * Date: 08.11.17
 * Time: 12:15
 */

namespace App;


class Currency
{
    public $shortName;
    public $fullName;
    public $price_usd;
    public $crypto;


    /*
     * search full name fiat value by iso
     * return full name string
     *
     * */
    public static function searchFiatFullNameByISO($iso)
    {
        $temp = Cr_cc_profile::where('profile_short', 'like', $iso)->first();
        if ($temp) {
            return $temp->profile_long;
        }
        return null;
    }

    /*
     * search price USD by ISO in fiat
     * return price double
     *
     * */
    public static function searchFiatPriceByISO($iso)
    {
        $iso = "USD" . $iso;
        $temp = ExchangeRate::where('name_quotes', 'like', $iso)->first();
        if ($temp) {
            return $temp->value_quotes;
        }
        return null;
    }

    /*
     * search full name crypto by ISO/symbol in global_data
     *
     * */
    public static function searchCryptoNameByISO($iso)
    {
        $temp = GlobalData::where('symbol', 'like', $iso)->first();
        if ($temp) {
            return $temp->name;
        }
        return null;
    }

    /*
     * search price crypto by ISO/symbol in global_data
     *
     * */
    public static function searchCryptoPriceByISO($iso)
    {
        $temp = GlobalData::where('symbol', 'like', $iso)->first();
        if ($temp) {
            return $temp->price_usd;
        }
        return null;
    }

    /*
     * set from default value
     *
     * */
    public static function setDefaultValueFrom()
    {
        $currencyFrom = new Currency();
        $currencyFrom->shortName = 'usd';
        $currencyFrom->fullName = Currency::searchFiatFullNameByISO($currencyFrom->shortName);
        $currencyFrom->price_usd = 1;
        $currencyFrom->crypto = false;
        return $currencyFrom;
    }

    /*
     * set from default value
     *
     * */
    public static function setDefaultValueTo()
    {
        $currencyTo = new Currency();
        $currencyTo->shortName = 'eur';
        $currencyTo->fullName = Currency::searchFiatFullNameByISO($currencyTo->shortName);
        $currencyTo->price_usd = Currency::searchFiatPriceByISO($currencyTo->shortName);
        $currencyTo->crypto = false;
        return $currencyTo;
    }
}