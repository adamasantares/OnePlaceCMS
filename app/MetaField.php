<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaField extends Model
{
    protected $fillable = ['title', 'slug', 'type', 'order', 'meta_content_id'];

    public function validations()
    {
        return $this->hasMany('App\MetaFieldValidation');
    }

    public function fields()
    {
        return $this->hasMany('App\Field');
    }

    public function content()
    {
        return $this->belongsTo('App\MetaContent');
    }
}
