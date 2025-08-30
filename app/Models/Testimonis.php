<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Testimonis extends Model
{
    protected $fillable = [
        'image_foto',
        'username',
        'comment',
        'location',
        'rating'
    ];

     public static function booted()
    {
        static::updating(function ($record) {
            if ($record->isDirty('image_foto')) {
                Storage::disk('public')->delete($record->getOriginal('image_foto'));
            }
        });

        static::deleting(function ($record) {
            if ($record->image_foto) {
                Storage::disk('public')->delete($record->image_foto);
            }
        });
    }
}
