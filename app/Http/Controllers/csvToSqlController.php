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
        $this->csv_to_array($_SERVER['DOCUMENT_ROOT'] . 'db/crypto_history.csv');
    }

    function csv_to_array($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            $nameCurrentTable = "";
            $counter = 0;
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                if (!$header)
                    $header = $row;
                else {
                    $data[] = array_combine($header, $row);
                    if ($data[$counter]['Name'] != $nameCurrentTable) {

                        if ($nameCurrentTable != "") {
                            try {
                                Schema::connection('mysql2')->create(quotemeta($nameCurrentTable), function ($table) {
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
                                $nameCurrentTable = $data[$counter - 1]['Symbol'];

                                Schema::connection('mysql2')->create(quotemeta($nameCurrentTable), function ($table) {
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

                            for ($i = 0; $i < count($data)-1; $i++) {
                                DB::connection('mysql2')->table(quotemeta($nameCurrentTable))->insert(
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

                            $nameCurrentTable = $data[$counter]['Name'];
                            $newTable = $data[$counter];
                            $data = array();
                            $data[] = $newTable;
                            $counter = 0;
                        }

                        if (count($data) > 0) {
                            $nameCurrentTable = $data[$counter]['Name'];
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
