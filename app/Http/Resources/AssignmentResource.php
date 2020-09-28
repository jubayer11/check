<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentResource extends JsonResource
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

            'title'=> $this->title,
            'body'=>$this->body,
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'deadline'=>$this->deadline,
            'file'=>$this->file,
            'created_at'=>$this->created_at->diffForHumans(),

        ];
    }
}
