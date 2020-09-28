<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LmsClassEventResource extends JsonResource
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
            'lmsclass_id'=>$this->lmsclass->id,
            'name'=>$this->name,
            'details'=>$this->details,
            'start'=>$this->start,
            'end'=>$this->end,
            'color'=>$this->color,
        ];
    }
}
