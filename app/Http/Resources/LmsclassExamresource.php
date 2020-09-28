<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LmsclassExamresource extends JsonResource
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
            'teacher_id'=>$this->teacher_id,
            'class_id' =>$this->class_id,
            'type'=>$this->type,
             'status_s'=>$this->status,
            'exam_done'=>$this->exam_done,
            'Active'=>$this->Active,
            'end_date_s'=>$this->end_date,
            'end_time_s'=>$this->end_time,
            'question_s'=>QuestionResource::collection($this->Question),
            'exam_done_Status'=>$this->users()->where('exam_id', $this->id)->get(),
            'exam_user'=>UserResource::collection($this->users),
        ];
    }
}
