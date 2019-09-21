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
    protected $appends = ['fields_formatted'];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->api_id = $model->model->api_id;
        });
    }

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

    public function setPublishedAttribute($value)
    {
        $this->attributes['published'] = ($value === 'true') || ($value === true);
    }

    public function getFieldsFormattedAttribute()
    {
        $result = [];
        $modelFields = $this->model->fields;

        foreach ($modelFields as $field) {
            $key = $field['api_id'];

            switch ($field['type']) {
                case "media":
                    $medias = $this->getMedia($key);

                    foreach ($medias as $media) {
                        $result[$key][] = $media->getFullUrl();
                    }

                    break;

                case "relation":
                    if($field['validations']['relation_type'] === 'one_to_many') {
                        if(isset($rootValue->fields[$key])) {
                            $result[$key] = Entry::whereIn('_id', $this->fields[$key])->where('published', true)->get();
                        } else {
                            $result[$key] = null;
                        }
                    }

                    break;

                default:
                    $result[$key] = $this->fields[$key];

                    break;
            }

        }

        return $result;
    }
}
