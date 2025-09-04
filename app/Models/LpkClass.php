<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LpkClass extends Model
{
   protected $fillable = [
        'image',
        'title',
        'desc',
        'waktu_pendidikan',
        'bersertifikat',
        'url',
        'active',
        'rating'
   ];

   public static function booted()
    {
        static::updating(function ($record) {
            if ($record->isDirty('image')) {
                Storage::disk('public')->delete($record->getOriginal('image'));
            }
        });

        static::deleting(function ($record) {
            if ($record->image) {
                Storage::disk('public')->delete($record->image);
            }
        });
    }
}
