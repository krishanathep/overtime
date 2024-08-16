<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OTrequestResource extends JsonResource
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
            'department_name'=>$this->department_name,
            'department'=>$this->department,
            'ot_member_id'=>$this->ot_member_id,
            'ot_date'=>$this->ot_date,
            'work_type'=>$this->work_type,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'total_date'=>$this->total_date,
            'status'=>$this->status,
            'result'=>$this->result,
            'create_name'=>$this->create_name,
            'created_at'=>$this->created_at,
            'ot_emp'=>$this->ot_emp,
            'work_type'=>$this->work_type,
            'name_app_1'=>$this->name_app_1,
            'name_app_2'=>$this->name_app_2,
            'name_app_3'=>$this->name_app_3,
            'name_app_4'=>$this->name_app_4,
            'email_app_1'=>$this->email_app_1,
            'email_app_2'=>$this->email_app_2,
            'email_app_3'=>$this->email_app_3,
            'email_app_4'=>$this->email_app_4,
            'bus_point_1'=>$this->bus_point_1,
            'bus_point_2'=>$this->bus_point_2,
            'bus_point_3'=>$this->bus_point_3,
            'bus_point_4'=>$this->bus_point_4,
            'employees'=> EmployeeResource::collection($this->employee)
        ];
    }
}
