<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class PostVideoYoutube extends Model
{
    protected $fillable = [
        'thumbnail',
        'url_video',
        'title',
        'desc',
        'category',
        'tag',
        'duration'
    ];

     public static function booted()
    {
        static::created(fn () => Cache::forget('post_video_youtube_trend'));
        static::updated(fn () => Cache::forget('post_video_youtube_trend'));
        static::deleted(fn () => Cache::forget('post_video_youtube_trend'));

        static::updating(function ($record) {
            if ($record->isDirty('thumbnail')) {
                Storage::disk('public')->delete($record->getOriginal('thumbnail'));
            }
        });

        static::deleting(function ($record) {
            if ($record->thumbnail) {
                Storage::disk('public')->delete($record->thumbnail);
            }
        });
    }
}
