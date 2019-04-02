<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentMoldelRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'max:255|required',
            'api_id' => 'max:255|unique:content_models,api_id,'.$this->segment(3).'|required',
            'desc' => 'max:1024',
        ];
    }
}
