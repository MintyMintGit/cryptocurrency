<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    public $incrementing = false;
    protected $fillable = [
        "id",
        "price_usd",
        "rate",
        "type",
        "profile_long",
        "exchange1",
        "exchange2"
    ];
}
