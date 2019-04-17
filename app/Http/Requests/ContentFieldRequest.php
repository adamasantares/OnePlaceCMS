<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentFieldRequest extends FormRequest
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
            'name' => 'max:255|required',
            'api_id' => 'max:255||required|unique:content_fields,api_id,'.request()->input('_id').',_id',
            'list' => 'boolean',
            'validations.*' => 'boolean'
        ];
    }
}
