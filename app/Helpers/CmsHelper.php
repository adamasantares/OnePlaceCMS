<?php

namespace App\Helpers;
use App\ContentModel;
use Illuminate\Http\Request;


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

    public static function validationFields(Request $request)
    {
        $model = ContentModel::where('_id', $request->input('model_id'))->first();
        $fields = $model->fields;

        $keysSelect = ['api_id', 'validations'];
        $filteredArray = array_columns($fields, $keysSelect);

        $validations = self::buildValidationsRules($filteredArray);

        return $request->validate($validations);
    }
}