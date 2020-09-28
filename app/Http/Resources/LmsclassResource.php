<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LmsclassResource extends JsonResource
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
            'status'=>$this->status,
            'classHead_id'=>$this->classhead_id,
            'classHead_status'=>$this->head->status,
            'name'=>$this->name,
            'section'=>$this->section,
            'description'=>$this->description,
            'teacher_name'=>$this->teacher_name,
            'user_id'=>$this->user_id,
            'code'=>$this->code,
            'exam'=>LmsclassExamresource::collection($this->exam),
            'created_at'=>$this->created_at->diffForHumans(),

        ];
    }
}
