<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Entry extends Eloquent
{
    protected $fillable = ['title', 'published', 'model_id', 'fields'];
}
