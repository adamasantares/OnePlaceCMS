<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaFieldValidation extends Model
{
    protected $fillable = ['slug', 'name', 'value', 'meta_field_id'];
}
