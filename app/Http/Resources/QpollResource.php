<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QpollResource extends JsonResource
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
           'option_1'=>$this->option_1,
           'option_2'=>$this->option_2,
           'option_3'=>$this->option_3,
           'option_4'=>$this->option_4,
           'marks'=>$this->marks,
           'Apoll'=>Apoll::collection($this->Apoll),
           'created_at'=>$this->created_at->diffForHumans(),


       ];
    }
}
