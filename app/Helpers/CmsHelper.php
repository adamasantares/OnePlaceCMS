<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use App\ContentModel;


class CmsHelper
{
    public static function buildValidationsRules(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'model_id' => 'required',
            'published' => 'required'
        ]);

        $validationsModel = ContentModel::find($request->input('model_id'))->fields()->select('api_id', 'validations')->get()->toArray();

        $validations = [];

        foreach ($validationsModel as $item) {
            $filter = array_filter($item['validations'], 'strlen');
            $keys = array_keys($filter);
            $validations['fields.' . $item['api_id']] = implode('|', $keys);
        }

        return $request->validate($validations);
    }
}