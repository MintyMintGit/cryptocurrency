<?php

namespace App\Http\Controllers;

use App\GlobalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\currencyHistory;

class TestImageController extends Controller
{
    public function index()
    {
        $allCryptoAPI = GlobalData::all()->toArray();
        foreach ($allCryptoAPI as $index => $item) {
            $name = $item['name'];
            $id = $item['id'];
            try {
                $crypto_history = \DB::connection('mysql2')->table($id)->get();
            } catch (\Illuminate\Database\QueryException $e) {
                try {
                    $crypto_history = \DB::connection('mysql2')->table($name)->get();
                } catch (\Illuminate\Database\QueryException $e) {
                    continue;
                }
            }
            $allCryptoAPI[$index]['crypto_history'] = $crypto_history->toArray();
        }

        foreach ($allCryptoAPI as $index => $item) {
            $data = array();
            if (isset($item['crypto_history'])) {
                foreach ($item['crypto_history'] as $item_cryptoHistory => $crypto_history) {
                    if ($this->IsLastWeek($crypto_history->created_at)) {
                        $data[] = $crypto_history->price_usd;
                    }
                }
            }
            /*if code disabled - creates empty white graphs*/
            foreach ($data as $key => $datum) {
                $data[$key] = doubleval($datum);
            }
            $this->saveToJson($data);

            $this->createGraph($item['id']);
        }
        self::updateCssImg();
        $this->updateIconsCrypto();
        $this->currencyPerDay();
        return "updated succsef";
    }

    public function createGraph($fileName)
    {
        $runServer = 'highcharts-export-server --infile ' . $_SERVER['DOCUMENT_ROOT'] . '/resources.json --outfile ' . $_SERVER['DOCUMENT_ROOT'] . '/img/crypto/' . $fileName . '.png';
        $res = shell_exec($runServer);
        return $res;
    }

    public function saveToJson($data)
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/resources.json';
        $json = json_decode(file_get_contents($file), TRUE);
        $json['series'] = [array("data" => $data, "type" => "line")];
        if (file_put_contents($file, json_encode($json)) == false) {
            return "resources.json can not write";
        }

    }

    public function IsLastWeek($date)
    {
        $now = new Carbon();
        if ($now->diffInWeeks(Carbon::parse($date)) <= 1) {
            return true;
        }
    }

    static function updateCssImg()
    {
        $returned_content = self::get_data('https://coinmarketcap.com/static/sprites/all_views_all_0.css');
        if ($returned_content != null) {
            $file = $_SERVER['DOCUMENT_ROOT'] . '/css' . '/cryptoicons.css';
            file_put_contents($file, $returned_content);
        }
        $returned_content = self::get_data('https://coinmarketcap.com/static/sprites/all_views_all_0.png');
        if ($returned_content != null) {
            $file = $_SERVER['DOCUMENT_ROOT'] . '/css' . '/all_views_all_0.png';
            file_put_contents($file, $returned_content);
        }
    }

    static function get_data($url)
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function updateIconsCrypto()
    {
        $allCryptoAPI = GlobalData::all()->toArray();
        foreach ($allCryptoAPI as $index => $item) {
            $name = $item['name'];
            $id = $item['id'];
            try {
                $returned_content = self::get_data('https://files.coinmarketcap.com/static/img/coins/32x32/' . "$id" . '.png');
                if ($returned_content != null) {
                    $file = $_SERVER['DOCUMENT_ROOT'] . '/img/icons/' . "$id" . '.png';
                    file_put_contents($file, $returned_content);
                } else {
                    $returned_content = self::get_data('https://files.coinmarketcap.com/static/img/coins/32x32/' . "$name" . '.png');
                    if ($returned_content != null) {
                        $file = $_SERVER['DOCUMENT_ROOT'] . '/img/icons/' . "$name" . '.png';
                        file_put_contents($file, $returned_content);
                    }
                }
            } catch (\Illuminate\Database\QueryException $e) {

            }
        }
    }

    public function currencyPerDay()
    {
        $data = \App\ExchangeRatesCap\Base::getExchangeRates();
        foreach ($data['quotes'] as $key => $datum) {
            $name = str_replace('USD', '', $key);
            currencyHistory::updateOrCreate(
                [
                    'name' => "{$name}"
                ],
                [
                    'price_old' => "{$datum}",
                    'crypto' => 0
                ]
            );
        }
        $data = \App\CoinMarketCap\Base::getGlobalData();
        foreach ($data as $key => $item) {
            currencyHistory::updateOrCreate(
                [
                    'name' => "{$item['id']}"
                ],
                [
                    'price_old' => "{$item['price_usd']}",
                    'crypto' => 1
                ]
            );
        }
    }
}
