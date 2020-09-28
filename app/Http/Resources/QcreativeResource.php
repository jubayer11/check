<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QcreativeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' =>$this->id,
            'question_id' => $this->question_id,
            'story' =>$this->story,
            'question_1' =>$this->question_1,
            'question_2' =>$this->question_2,
            'question_3' =>$this->question_3,
            'question_4' =>$this->question_4,
            'q1_marks' =>$this->q1_marks,
            'q2_marks' => $this->q2_marks,
            'q3_marks' => $this->q3_marks,
            'q4_marks' => $this->q4_marks,
            'all_marks'=> $this->all_marks,
            'Acreatives'=>Acreative::collection($this->Acreative),
            'created_at'=>$this->created_at->diffForHumans(),





        ];
    }
}
