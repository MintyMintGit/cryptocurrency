<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class GlobalDataResource extends Resource
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
            'rank' => $this->rank,
            'name' => $this->name,
            'symbol' => $this->symbol,
            'market_cap_usd' => $this->market_cap_usd,
            'price_usd' => $this->price_usd,
            'available_supply' => $this->available_supply,
            'volume_usd_24h' => $this->volume_usd_24h,
            'total_supply' => $this->total_supply,
            'percent_change_24h' => $this->percent_change_24h,
            '' =>''
        ];
    }
}
