<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use App\ContentModel;


class CmsHelper
{
    public static function buildValidationsRules(Request $request)
    {
        $validationsModel = ContentModel::find($request->input('model_id'))->fields()->select('api_id', 'validations')->get()->toArray();

        $validations = [];

        foreach ($validationsModel as $item) {

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

        return $request->validate($validations);
    }
}