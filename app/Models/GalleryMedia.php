<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryMedia extends Model
{
    protected $fillable = [
        'bg_image',
        'img',
        'title',
        'location'
    ];

    protected $casts = [
        'bg_image' => 'array'
    ];

     public static function booted()
    {
        static::updating(function ($record) {
            if ($record->isDirty('img')) {
                Storage::disk('public')->delete($record->getOriginal('img'));
            }
            if ($record->isDirty('bg_image')) {
                $original = (array) $record->getOriginal('bg_image');
                $current = (array) $record->bg_image;

                $deleted = array_diff($original, $current);
                foreach ($deleted as $path) {
                    Storage::disk('public')->delete($path);
                }
            }
        });

        static::deleting(function ($record) {
            if ($record->img) {
                Storage::disk('public')->delete($record->img);
            }
            if ($record->bg_image) {
                foreach ($record->bg_image as $path) {
                    Storage::disk('public')->delete($path);
                }
            }
        });
    }
}
