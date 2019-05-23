<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use App\ContentField;


class CmsHelper
{
    public static function buildValidationsRules($fields)
    {
        $validations = [];

        foreach ($fields as $item) {

            foreach ($item['validations'] as $validation => $value) {

                if($value === true) {
                    $validations['fields.' . $item['api_id']][] = $validation;
                }
            }

            if(isset($item['validations']['specific'])) {
                if($item['validations']['specific'] == 'pattern') {
                    $validations['fields.' . $item['api_id']][] = 'regex:'.$item['validations']['pattern'];
                } else {
                    $validations['fields.' . $item['api_id']][] = $item['validations']['specific'];
                }
            }

        }

        $validations = array_map(function($rules) { return implode('|', $rules); }, $validations);

        return $validations;
    }

    public static function validationFiles(Request $request)
    {
        $field = ContentField::where('model_id', $request->input('model_id'))
                            ->where('api_id', $request->input('field_api_id'))
                            ->firstOrFail();

        $validations = 'mimes:' . implode(',', $field->validations['mime']);

        return $request->validate([
            'file' => $validations
        ]);
    }

    public static function validationFields(Request $request)
    {
        $fields = ContentField::where('model_id', $request->input('model_id'))->where('type', '!=', 'media')->select('api_id', 'validations')->get()->toArray();

        $validations = self::buildValidationsRules($fields);

        return $request->validate($validations);
    }
}