<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ContentField extends Eloquent
{
    protected $fillable = ['name', 'api_id', 'type', 'list', 'order', 'validations', 'model_id'];
}
