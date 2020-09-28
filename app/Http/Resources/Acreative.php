<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Acreative extends JsonResource
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
            'question_id'=>$this->question_id,
            'qcreative_id'=>$this->qreative_id,
            'user_id'=>$this->user_id,
            'aquestion_1'=>$this->aquestion_1,
            'aq1_marks'=>$this->aq1_marks,
            'aquestion_2'=>$this->aquestion_2,
            'aq2_marks'=>$this->aq2_marks,
            'aquestion_3'=>$this->aquestion_3,
            'aq3_marks'=>$this->aq3_marks,
            'aquestion_4'=>$this->aquestion_4,
            'aq4_marks'=>$this->aq4_marks,


        ];

    }
}
