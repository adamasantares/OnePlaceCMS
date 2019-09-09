<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Entry extends Eloquent implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['title', 'published', 'model_id', 'fields'];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    public function model()
    {
        return $this->belongsTo('App\ContentModel', 'model_id');
    }
}
