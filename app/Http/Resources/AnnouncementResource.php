<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementResource extends JsonResource
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
            'lmsclass_id'=>$this->lmsclass_id,
            'title'=>$this->title,
            'body'=>$this->body,
            'created_at'=>$this->created_at->diffForHumans(),
            'first_name'=>$this->user->first_name,
            'last_name'=>$this->user->last_name,
            'image'=>$this->user->image,

        ];
    }
}
