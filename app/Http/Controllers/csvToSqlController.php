<?php

namespace App\Http\Controllers;

use App\GlobalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class csvToSqlController extends Controller
{
    public function index()
    {

//        str_getcsv('public/db/crypto_history.csv');


        $data = $this->csv_to_array($_SERVER['DOCUMENT_ROOT'] . 'db/crypto_history.csv');
        foreach ($data as $datum) {
            $a = 10;
        }

        /****************************************
         * CSV FILE SAMPLE *
         ****************************************/
        // id,subdireccion_id,idInterno,area,deleted_at,created_at,updated_at
        // ,1,4,AREA MALAGA OCC.,,2013/10/13 10:27:52,2013/10/13 10:27:52
        // ,1,2,AREA MALAGA N/ORIENT,,2013/10/13 10:27:52,2013/10/13 10:27:52

        $csvFile = public_path() . 'public/db/crypto_history.csv';


        // Uncomment the below to run the seeder
//        DB::table('crypto_history')->insert($areas);
    }

    function csv_to_array($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            $temp = "";
            $counter = 0;
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                if (!$header)
                    $header = $row;
                else {
                    $data[] = array_combine($header, $row);
                    if ($data[$counter]['Name'] != $temp) {

//Name,Symbol,Date,High,Low,Close,Volume,Market,Cap
                        if ($temp != "") {


                            //GlobalData::find('')
                            try {
                                Schema::connection('mysql2')->create(quotemeta($temp), function ($table) {
                                    $table->increments('id');
                                    $table->string('Name');
                                    $table->string('Symbol');
                                    $table->string('Date');
                                    $table->double('High');
                                    $table->double('Low');
                                    $table->double('Close');
                                    $table->double('Volume');
                                    $table->double('Market');
                                    $table->double('Cap');
                                });

                            } catch (\Illuminate\Database\QueryException $e) {
                                $temp = $data[$counter - 1]['Symbol'];

                                Schema::connection('mysql2')->create(quotemeta($temp), function ($table) {
                                    $table->increments('id');
                                    $table->string('Name');
                                    $table->string('Symbol');
                                    $table->string('Date');
                                    $table->double('High');
                                    $table->double('Low');
                                    $table->double('Close');
                                    $table->double('Volume');
                                    $table->double('Market');
                                    $table->double('Cap');
                                });

                            } catch (PDOException $e) {
                                dd($e);
                            }

                            for ($i = 0; $i < count($data - 1); $i++) {
                                DB::connection('mysql2')->table(quotemeta($temp))->insert(
                                    [
                                        'Name' => $data[$i]['Name'],
                                        'Symbol' => $data[$i]['Symbol'],
                                        'Date' => $data[$i]['Date'],
                                        'High' => $data[$i]['High'],
                                        'Low' => $data[$i]['Low'],
                                        'Close' => $data[$i]['Close'],
                                        'Volume' => $data[$i]['Volume'],
                                        'Market' => $data[$i]['Market'],
                                        'Cap' => $data[$i]['Cap']
                                    ]
                                );
                            }

                            $temp = $data[$counter]['Name'];
                            $data = $data[$counter];
                            $counter = 0;

                        }

                        if (count($data) > 0) {
                            $temp = $data[$counter]['Name'];
                        }

                    }
                    $counter++;
                }

            }
            fclose($handle);
        }
        return $data;
    }
}
