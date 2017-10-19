<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    public $timestamps = false;
    protected $fillable = ['timestamp', 'source', 'name_quotes', 'value_quotes', 'value_quotesOld'];

    public static function crossRates($from, $to)
    {
        return $from / $to;
    }
}
