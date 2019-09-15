<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Entry extends Eloquent implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['title', 'published', 'model_id', 'api_id', 'fields'];

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

    public function getFieldsFormattedAttribute()
    {
        $result = [];
        $modelFields = $this->model->fields;

        foreach ($modelFields as $field) {
            $key = $field['api_id'];

            if($field['type'] === 'media') {
                $medias = $this->getMedia($key);

                foreach ($medias as $media) {
                    $result[$key][] = $media->getFullUrl();
                }
            }

            if($field['type'] === 'relation') {
                if($field['validations']['relation_type'] === 'one_to_many') {
                    if(isset($this->fields[$key])) {
                        $result[$key] = Entry::whereIn('_id', $this->fields[$key])->where('published', true)->get();
                    } else {
                        $result[$key] = null;
                    }
                }
            }
        }

        return $result;
    }

    public function setPublishedAttribute($value)
    {
        $this->attributes['published'] = ($value === 'true');
    }
}
