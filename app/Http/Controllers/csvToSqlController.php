<?php

namespace App\Http\Controllers;

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

        $csvFile = public_path().'public/db/crypto_history.csv';

        $areas = csv_to_array($csvFile);


        // Uncomment the below to run the seeder
//        DB::table('crypto_history')->insert($areas);
    }
    function csv_to_array($filename='', $delimiter=',')
    {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            $temp = "";
            $counter = 0;
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else {
                    $data[] = array_combine($header, $row);
                    if($data[$counter]['Name'] != $temp ) {

//Name,Symbol,Date,High,Low,Close,Volume,Market,Cap
                        if($temp != "") {
                            Schema::connection('mysql2')->create($temp, function($table)
                            {
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

                            foreach ($data as $datum) {
                                DB::connection('mysql2')->table($temp)->insert(
                                    [
                                        'Name' => $datum['Name'],
                                        'Symbol' => $datum['Symbol'],
                                        'Date' => $datum['Date'],
                                        'High' => $datum['High'],
                                        'Low' => $datum['Low'],
                                        'Close' => $datum['Close'],
                                        'Volume' => $datum['Volume'],
                                        'Market' => $datum['Market'],
                                        'Cap' => $datum['Cap']
                                    ]
                                );
                            }
                            $data[] = array();
                        }
                        $temp = $data[$counter]['Name'];
                    }
                    $counter++;
                }

            }
            fclose($handle);
        }
        return $data;
    }
}
