<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;


class QuestionResource extends JsonResource
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
            'exam_id'=>$this->exam_id,
            'type'=>$this->type,
            'creative_s_s'=>QcreativeResource::collection($this->Qcreative),
            'multiple_s_s'=>QmultipleResource::collection($this->Qmultiple),
            'poll_s_s'=>QpollResource::collection($this->Qpoll),
            'short_s_s'=>QshortResource::collection($this->Qshort),
            'created_at' =>$this->created_at,
        ];
    }
}
