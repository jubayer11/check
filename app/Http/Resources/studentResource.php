<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class studentResource extends JsonResource
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
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'father_name'=>$this->father_name,
            'mother_name'=>$this->mother_name,
            'phone'=>$this->email,
            'parents_contact'=>$this->parents_contact,
            'email'=>$this->phone,
            'nid'=>$this->nid,
            'image'=>$this->image,
            'address'=>$this->address,
            'Status'=>$this->status,
            'login_time'=>$this->last_login_at,
            'login_ip'=>$this->last_login_ip,
            'role'=>$this->getRoleNames()->first(),
            'class_head'=>classHeadResorce::collection($this->classHead),
            'subject'=>SubjectResource::collection($this->lmsclass),
        ];

    }
}
