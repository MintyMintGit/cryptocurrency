<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Graph {
//    public $title = "";
//    public $subtitle = "";
//    public $yAxis = "";
//    public $xAxis = "";
//    public $legend = "";
//    public $plotOptions = "";
//    public $series = "";
//    public $responsive = "";
}

class TestImageController extends Controller
{
    public function index()
    {

/*это рабочий вариант*/

//curl -H "Content-Type: application/json" -X POST -d '{"infile":{"title": {"text": "Steep Chart"}, "xAxis": {"categories": ["Jan", "Feb", "Mar"]}, "series": [{"data": [29.9, 71.5, 106.4]}]}}' 127.0.0.1:7801 -o mychart.png
        //curl -H "Content-Type: application/json" -X POST -d '{"infile":{"title": {"text": "Steep Chart"}, "xAxis": {"categories": ["Jan", "Feb", "Mar"]}, "series": [{"data": [29.9, 71.5, 106.4]}]}}' 127.0.0.1:7801 -o mychart.png
        //это наш//highcharts-export-server instr {"infile":{"title":{"text":"Solar Employment Growth by Sector, 2010-2016"},"subtitle":{"text":"Source: thesolarfoundation.com"},"yAxis":{"title":{"text":"Fruit eaten"}},"xAxis":{"categories":["Apples","Oranges","Bananas"]},"legend":{"layout":"vertical","align":"right","verticalAlign":"middle"},"plotOptions":"","series":[{"name":"John","data":[5,7,3]},{"name":"Jane","data":[1,0,4]}],"responsive":""}}'
        //это наш//curl -H "Content-Type: application/json" -X POST -d '{"infile":{"title":{"text":"Solar Employment Growth by Sector, 2010-2016"},"subtitle":{"text":"Source: thesolarfoundation.com"},"yAxis":{"title":{"text":"Fruit eaten"}},"xAxis":{"categories":["Apples","Oranges","Bananas"]},"legend":{"layout":"vertical","align":"right","verticalAlign":"middle"},"plotOptions":"","series":[{"name":"John","data":[5,7,3]},{"name":"Jane","data":[1,0,4]}],"responsive":""}}' 127.0.0.1:7801 -o mychartSecond2.png





        /*перепишу вариант 1 для создания графика*/ /*пишет no input specifiead*/
//        $obj = new Graph();
//        $obj->title = array('text' => "Solar Employment Growth by Sector, 2010-2016");
//        $obj->subtitle = array('text' => "Source: thesolarfoundation.com");
//        $obj->xAxis = array('categories' => ['Apples', 'Oranges', 'Bananas']);
//        $obj->yAxis = array('title' => array('text' => 'Fruit eaten'));
//        $obj->legend = array('layout' => 'vertical', 'align' => 'right', 'verticalAlign' => 'middle');
//
//        $obj->series = array(array('name'=> 'John', 'data' => [5, 7, 3]), array('name' => 'Jane', 'data' => [1, 0, 4]));
        //$obj->series =[[]];

        //echo json_encode($obj);
        //$infile = array("instr" => $obj);
        //$runServer = 'highcharts-export-server logDest /var/www/cryptocurrency.local/cryptocurrency logFile example.log instr ' . json_encode($obj);
        //$runServer = 'highcharts-export-server instr ' . json_encode($obj);
        //var_dump($runServer);
        //dd(shell_exec($runServer));
        //dd(json_encode($obj));

        /*этот вариант 1 не создает файл с указанным именем, пишет ошибку со скобочкой в созданном файле*/
//        $runServer = 'highcharts-export-server instr "chart": {"type": "arearange"},"title": {"text": "Temperature variation by day"},"xAxis": {"type": "datetime"},"yAxis": {"title": {"text": "null"}},"tooltip": {"crosshairs": "true","shared": "true","valueSuffix": "°C"},"legend": {"enabled": "false"},"series": [{"name": "Temperatures","data": [5,3,4,2],"color": "#FF0000","negativeColor": "#0088FF"}]  -o /var/www/cryptocurrency.local/cryptocurrency/public/mychart.png';
//        $res = shell_exec($runServer);
//        return $res;




        /*это вариант для http сервера, возможно неправильные данные для графика*/


        // The data to send to the API
        $postData = array(
            'constr' => 'Chart',
            'type' => 'png',
            'title' => array('text'=>'Street chap'),
            'options' => array('xAxis' => array("categories", ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"])),
            "series" => array(array('data'=>[1,3,2,4], 'type'=>'line'), array('data'=>[5,3,4,2], 'type'=>'line'))
        );
        // Create the context for the request

        $context = stream_context_create(array(
            'http' => array(
                // http://www.php.net/manual/en/context.http.php
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => json_encode($postData)
            )
        ));

        // Send the request
        $response = file_get_contents('http://0.0.0.0:7801/' ,FALSE, $context);

        // Check for errors
        if ($response === FALSE) {
            die('Error');
        }
//        $request = new \HttpRequest();
//        $request->setUrl('http://0.0.0.0:7801/');
//        $request->setMethod(HTTP_METH_POST);
//
//        $request->setHeaders(array(
//            'cache-control' => 'no-cache',
//            'content-type' => 'application/json',
//            'postman-token' => '02c50af7-40fd-e962-93b0-1a18819194c7'
//        ));
//
//        $request->setBody('{
//  "constr": "Chart",
//  "type": "png",
//  "title": {"text": "Steep Chart"},
//  "options": {
//    "xAxis": [
//      "categories",
//      [
//        "Jan",
//        "Feb",
//        "Mar",
//        "Apr",
//        "May",
//        "Jun",
//        "Jul",
//        "Aug",
//        "Sep",
//        "Oct",
//        "Nov",
//        "Dec"
//      ]
//    ]
//  },
//  "series": [
//    {
//      "data": [
//        1,
//        3,
//        2,
//        4
//      ],
//      "type": "line"
//    },
//    {
//      "data": [
//        5,
//        3,
//        4,
//        2
//      ],
//      "type": "line"
//    }
//  ]
//}');
//
//        try {
//            $response = $request->send();
//            file_put_contents($_SERVER['DOCUMENT_ROOT'] . 'tmp/flower.png', $response);
//        dd($response);
//            //echo $response->getBody();
//        } catch (HttpException $ex) {
//            echo $ex;
//        }
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . 'tmp/flower.png', $response);
        dd($response);

    }
    public function someRequest() {
        //$input = Request::all();
        return "hello World!!!";
        $a =10;
    }
}
