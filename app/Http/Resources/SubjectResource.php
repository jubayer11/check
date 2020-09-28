<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'id'=>$this->id,
            'name'=>$this->name,
            'class_name'=>$this->head->name,
            'class_id'=>$this->classhead_id,
            'class_head_id'=>$this->head->id,
            'section'=>$this->section,
            'description'=>$this->description,
            'status'=>$this->status,
            'teacher_name'=>UserResource::collection($this->users),


        ];
    }
}
