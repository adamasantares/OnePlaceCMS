<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class MediaTemporaryStorage extends Eloquent
{
    protected $fillable = ['name', 'path', 'size'];
}
