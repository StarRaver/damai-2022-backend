<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExchangeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array|Arrayable|\JsonSerializable
     */
    public static $wrap = null;
    public function toArray($request)
    {
        // TODO: response data {"exchange_rate": 0.25, "udpated_at": "2022-01-01 23:59:59"}
        if(!empty($this->error)){
            return ["error"=> $this->error, "udpated_at"=> $this->updated_at];
        } else {
            return ["exchange_rate"=> $this->exchange_rate, "udpated_at"=> $this->updated_at];
        }
    }
}
