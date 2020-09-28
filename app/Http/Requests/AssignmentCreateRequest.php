<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title'=>'bail|required|max:40',
            'body'=>'required',
            'deadline'=>'required',
            'user_id'=>'required',
            'class_id'=>'required',
        ];
    }
}
