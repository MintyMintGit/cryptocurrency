<?php

namespace App\Http\Controllers;

use View;
use App\Search\Base;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $exchange_pairs = Base::getFullListSearch();
        View::share('exchange_pairs', $exchange_pairs);
    }
}
