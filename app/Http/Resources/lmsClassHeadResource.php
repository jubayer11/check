<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class lmsClassHeadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
            [
                'id'=>$this->id,
                'name'=>$this->name,
                'status'=>$this->status,
                'subject'=>SubjectResource::collection($this->Lms_class),
                'auth_subject'=>SubjectIdResource::collection(auth()->user()->lmsclass),
            ];
    }
}
