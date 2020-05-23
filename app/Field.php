<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = ['content_id', 'contents', 'cascade', 'value', 'meta_field_id'];
    public $appends = ['slug'];

    public function meta()
    {
        return $this->belongsTo('App\MetaField', 'meta_field_id', 'id');
    }

    public function getSlugAttribute()
    {
        return optional($this->meta)->slug;
    }
}
