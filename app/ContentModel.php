<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ContentModel extends Eloquent
{
    protected $fillable = ['title', 'api_id', 'desc'];
}
