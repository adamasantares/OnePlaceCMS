<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Project extends Eloquent
{
    protected $fillable = ['title', 'published', 'key'];
}
