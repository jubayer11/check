<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QshortResource extends JsonResource
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
            'question_s'=>$this->question,
            'marks'=>$this->marks,
            'Ashort'=>Ashort::collection($this->Ashort),

        ];

    }
}
