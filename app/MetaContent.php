<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaContent extends Model
{
    protected $fillable = ['title', 'slug', 'desc', 'published'];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function fields()
    {
        return $this->hasMany('App\MetaField');
    }

    public function contents()
    {
        return $this->hasMany('App\Content');
    }
}
