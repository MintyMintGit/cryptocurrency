<?php

namespace App\Http\Controllers;

use App\GlobalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            foreach ($data as $key => $datum) {
                $data[$key] = $datum * 10000000000;
            }
            $this->saveToJson($data);

            $this->createGraph($item['id']);
        }
        return "updated succsef";
    }

    public function createGraph($fileName)
    {
        $runServer = 'highcharts-export-server --infile '. $_SERVER['DOCUMENT_ROOT'] .'/resources.json --outfile '. $_SERVER['DOCUMENT_ROOT'] .'/img/crypto/' . $fileName . '.png';
        $res = shell_exec($runServer);
        return $res;
    }

    public function saveToJson($data)
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/resources.json';
        $json = json_decode(file_get_contents($file), TRUE);
        $json['series'] = [ array("data" => $data, "type" => "line")];
        file_put_contents($file, json_encode($json));
    }

    public function IsLastWeek($date)
    {
        $now = new Carbon();
        if ($now->diffInWeeks(Carbon::parse($date)) <= 10) {
            return true;
        }
    }
}
