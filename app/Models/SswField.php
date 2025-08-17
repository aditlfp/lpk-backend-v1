<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SswField extends Model
{
    protected $fillable = [
        'image_icon',
        'title',
        'subtitle_japan',
        'desc',
        'jumlah_dibutuhkan',
    ];

    public static function booted()
    {
        static::updating(function ($record) {
            if ($record->isDirty('image_icon')) {
                Storage::disk('public')->delete($record->getOriginal('image_icon'));
            }
        });

        static::deleting(function ($record) {
            if ($record->image_icon) {
                Storage::disk('public')->delete($record->image_icon);
            }
        });
    }
}
