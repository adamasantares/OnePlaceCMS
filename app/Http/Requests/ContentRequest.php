<?php

namespace App\Http\Requests;

use App\ContentModel;
use Illuminate\Foundation\Http\FormRequest;

//todo refactor
class ContentRequest extends FormRequest
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
     * Create validation rules by model
     *
     * @return array
     */
//    private function createRulesByModel()
//    {
//        $fieldsValidations = [];
//        $mediaValidations = [];
//
//        $model = ContentModel::where('_id',  $this->request->get('model_id'))->first();
//        $fields = $model->fields;
//
//        $keysSelect = ['api_id', 'type', 'validations'];
//        $filteredArray = array_columns($fields, $keysSelect);
//
//        foreach ($filteredArray as $item) {
//            if($item['type'] == 'media') {
//                array_push($mediaValidations, $item);
//            } else {
//                array_push($fieldsValidations, $item);
//            }
//        }
//
//        $mediaRules = $this->createRulesForMediaFields($mediaValidations);
//        $fieldsRules = $this->createRulesForFields($fieldsValidations);
//
//        $rules = array_merge($mediaRules, $fieldsRules);
//
//        return $rules;
//    }

    /**
     * Create validation rules for model fields
     *
     * @param $fields
     * @return array
     */
//    private function createRulesForFields($fields)
//    {
//        $rules = [];
//
//        foreach ($fields as $item) {
//
//            foreach ($item['validations'] as $validation => $value) {
//
//                if($value === true) {
//                    $rules['fields.' . $item['api_id']][] = $validation;
//                }
//            }
//
//            if(isset($item['validations']['specific'])) {
//                if($item['validations']['specific'] == 'pattern') {
//                    $rules['fields.' . $item['api_id']][] = 'regex:'.$item['validations']['pattern'];
//                } else {
//                    $rules['fields.' . $item['api_id']][] = $item['validations']['specific'];
//                }
//            }
//
//        }
//
//        $rules = array_map(function($rules) { return implode('|', $rules); }, $rules);
//
//        return $rules;
//    }

    /**
     * Create validation rules for media fields
     *
     * @param $fields
     * @return array
     */
//    private function createRulesForMediaFields($fields)
//    {
//        $rules = [];
//        $oldFilesInfo = $this->request->get('old_files_info');
//
//        foreach ($fields as $item) {
//
//            foreach ($item['validations'] as $validation => $value) {
//
//                if(isset($oldFilesInfo[$item['api_id']]) && ($validation == 'required')) {
//                    continue;
//                }
//
//                if($value === true) {
//                    $rules['files.' . $item['api_id']][] = $validation;
//                }
//            }
//
//            if(isset($item['validations']['mime'])) {
//                $rules['files.' . $item['api_id'] . '.*'][] = "mimes:" . implode(",", $item['validations']['mime']);
//            }
//        }
//
//
//        $rules = array_map(function($rules) { return implode('|', $rules); }, $rules);
//
//        return $rules;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'meta_content_id' => 'required',
            'published' => 'required'
        ];

//        $modelFieldsRules = $this->createRulesByModel();
//
//        $rules = array_merge($metaFieldsRules, $modelFieldsRules);

//        return $rules;
    }
}
