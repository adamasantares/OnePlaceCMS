<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Content extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['title', 'published', 'meta_content_id'];

    protected $casts = [
        'published' => 'boolean'
    ];

//    public $appends = ['metaFields'];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    public function fields()
    {
        return $this->hasMany('App\Field');
    }

    public function meta()
    {
        return $this->belongsTo('App\MetaContent', 'meta_content_id', 'id');
    }

//    public function getMetaFieldsAttribute()
//    {
//        $meta = $this->meta()->first();
//
//        if($meta) {
//            return $meta->fields()->get();
//        }
//    }

}
