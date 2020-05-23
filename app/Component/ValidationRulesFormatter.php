<?php


namespace App\Component;


class ValidationRulesFormatter
{
    private function format($name, $value)
    {
        if($value === true) {
            return $name;
        }

//        if(isset($item['validations']['specific'])) {
//            if($item['validations']['specific'] == 'pattern') {
//                $rules['fields.' . $item['api_id']][] = 'regex:'.$item['validations']['pattern'];
//            } else {
//                $rules['fields.' . $item['api_id']][] = $item['validations']['specific'];
//            }
//        }


//        $rules = array_map(function($rules) { return implode('|', $rules); }, $rules);

//        return $rules;
    }
}
