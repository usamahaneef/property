<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $hidden = ['media'];
    protected $with = ['profile'];
    protected $appends = ['profile_url'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile')->singleFile()->onlyKeepLatest(1);
    }

    public function profile()
    {
        return $this->morphOne(config('media-library.media_model'), 'model')
            ->where('collection_name', 'profile')->latest();
    }
    
    public function getProfileUrlAttribute()
    {
        $url = null;
        if ($this->relationLoaded('profile')) {
            $url = optional($this->profile)->getUrl();
        }
        return $url ? asset($url): asset('admin/img/avatar.png');
    }   use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'zip'];
}
