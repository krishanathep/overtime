<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeScanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'index'=>$this->index, 
            'pin'=>$this->pin, 
            'time'=>$this->time, 
            'state'=>$this->state,
            'created_at'=>$this->created_at,
        ];
    }
}
