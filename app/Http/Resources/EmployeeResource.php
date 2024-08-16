<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'id'=>$this->id,
            'ot_emp_id'=>$this->ot_emp_id,
            'emp_name'=>$this->emp_name,
            'cost_type'=>$this->cost_type,
            'job_type'=>$this->job_type,
            'objective'=>$this->objective,
            'bus_stations'=>$this->bus_stations,
            'code'=>$this->code,
            'target'=>$this->target,
            'scan'=>$this->scan,
            'out_time'=>$this->out_time,
            'some_time'=>$this->some_time,
            'remark'=>$this->remark,
            'bus_price'=>$this->bus_price,
            'time_scan'=> TimeScanResource::collection($this->timeScanModel)
        ];
    }
}
