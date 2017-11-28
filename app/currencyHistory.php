<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class currencyHistory extends Model
{
    protected $fillable = ["name", "price_old", "crypto"];
}
