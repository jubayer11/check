<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassRoutineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'details'=>$this->details,
            'color'=>$this->color,
            'type'=>$this->type,
            'delete_id'=>$this->deleteId,
            'start_date'=>$this->start_date,
            'start_time'=>$this->start_time,
            'end_date'=>$this->end_date,
            'end_time'=>$this->end_time,
            'start'=>$this->start_date.' '.$this->start_time,
            'end'=>$this->end_date.' '.$this->end_time,
        ];
    }
}
