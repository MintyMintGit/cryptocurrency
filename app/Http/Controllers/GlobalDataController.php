<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobalDataController extends Controller
{
    public function index()
    {
        return view('globalData.index');
    }
}
