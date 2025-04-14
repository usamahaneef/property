<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Property extends Model implements HasMedia
{
    use  HasFactory, InteractsWithMedia;

    protected $with = ['cover'];
    protected $hidden = ['cover'];
    protected $appends = ['cover_url'];
    // protected $casts = [
    //     'date_time' => 'datetime:F d, Y l h:i A',
    // ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('property_images')->onlyKeepLatest(5);
        $this->addMediaCollection('cover_img')->singleFile();
    }

    public function cover(): MorphOne
    {
        return $this->morphOne(config('media-library.media_model'), 'model')
        ->where('collection_name' , 'cover_img');
    }
    
    public function getCoverUrlAttribute()
    {
        $url = null;
        if ($this->relationLoaded('cover')) {
            $url = optional($this->cover)->getUrl();
        }
        return $url ? asset($url): asset('admin/img/cover/placeholder.png');
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
