<?php

namespace App\ExchangeRatesCap;


class Base
{
    /**
     * @var string
     */
    const API_URL = "https://www.apilayer.net/api/live?access_key=";

    /**
     * @var string
     */
    const FORMAT = "&format=1";
    /**
     * cURL handle.
     *
     * @var resource
     */
    private static $ch = null;

    public static function getExchangeRates(array $req = [])
    {
        $url = self::API_URL . $api_key = env("ExchangeRateKey") . self::FORMAT;
        usleep(120000);
        // generate the POST data string
        $postData = http_build_query($req, '', '&');
        if (is_null(self::$ch)) {
            self::$ch = curl_init();
            curl_setopt(self::$ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                self::$ch,
                CURLOPT_USERAGENT,
                'Mozilla/4.0 (compatible; CoinMarketCap PHP API; ' . php_uname('a') . '; PHP/' . phpversion() . ')'
            );
        }
        curl_setopt(self::$ch, CURLOPT_URL, $url . "?" . $postData);
        curl_setopt(self::$ch, CURLOPT_SSL_VERIFYPEER, false);

        // run the query
        $res = curl_exec(self::$ch);
        if ($res === false) {
            throw new \Exception("Curl error: " . curl_error(self::$ch));
        }
        $json = json_decode($res, true);

        if (isset($json['error'])) {
            throw new \Exception("getExchangeRates API error: {$json['error']}");
        }
        return $json;
    }
}