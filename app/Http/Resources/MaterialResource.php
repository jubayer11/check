<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
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
            'user_id'=>$this->user_id,
            'first_name'=>$this->user->first_name,
            'last_name'=>$this->user->last_name,
            'lmsclass_id'=>$this->lmsclass_id,
            'lecture'=>$this->lecture_no,
            'title'=>$this->title,
            'body'=>$this->body,
            'option'=>$this->option,
            'file'=>$this->file,
            'created_at'=>$this->created_at->diffForHumans(),
        ];
    }
}
