<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ExchangeRates extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name_quotes' => $this->name_quotes,
            'value_quotes' => $this->value_quotes
        ];
    }
}
