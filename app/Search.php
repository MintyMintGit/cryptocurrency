<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    public $incrementing = false;
    protected $fillable = [
        "id",
        "price_usd",
        "rate",
        "type",
        "profile_long",
        "exchange1",
        "exchange2"
    ];

    public static function getCloudsOfCurrencies()
    {
        $collectionPopularCurrencies = self::GetMost54PopularCurrencies();
        self::selectMost5PopularCurrencies($collectionPopularCurrencies);
        return $collectionPopularCurrencies->sortBy('profile_long');
    }

    public static function GetMost54PopularCurrencies()
    {
        return self::where('type','!=','exchange_pair')->orderBy('rate','desc')->take(54)->get();
    }

    public static function selectMost5PopularCurrencies($collectionPopularCurrencies)
    {
        for($i = 0; $i< 5; $i++) {
            $collectionPopularCurrencies[$i]['topPopular'] = true;
        }
    }
}
