<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ContentModel extends Eloquent
{
    protected $fillable = ['title', 'fields', 'api_id', 'desc', 'published'];
}
