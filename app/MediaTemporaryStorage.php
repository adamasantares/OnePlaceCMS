<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class MediaTemporaryStorage extends Eloquent
{
    protected $fillable = ['name', 'path', 'size'];

    public function delete()
    {
        Storage::delete($this->path);

        parent::delete();
    }
}
