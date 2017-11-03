<?php

namespace App\Http\Controllers;

use App\TotalMarketCap;
use View;
use App\Search\Base;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $totalMarketCap;
    public function __construct() {
        $this->totalMarketCap = TotalMarketCap::find(1)->get();
        $this->totalMarketCap = $this->totalMarketCap->toArray()[0]['price'];
        session()->put('totalMarketCap', $this->totalMarketCap);
    }
}
