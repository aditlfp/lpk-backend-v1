<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MainHero extends Model
{
    protected $fillable = [
        "c_image",
        "main_logo",
        "text_logo",
        "title",
        "desc",
        "collab_logo",
        "is_pinned"
    ];

    protected $casts = [
        "collab_logo" => 'array'
    ];

     public static function booted()
    {
        static::updating(function ($record) {
            if ($record->isDirty('c_image')) {
                Storage::disk('public')->delete($record->getOriginal('c_image'));
            }
            if ($record->isDirty('main_logo')) {
                Storage::disk('public')->delete($record->getOriginal('main_logo'));
            }
            if ($record->isDirty('collab_logo')) {
                $original = (array) $record->getOriginal('collab_logo');
                $current = (array) $record->collab_logo;

                $deleted = array_diff($original, $current);
                foreach ($deleted as $path) {
                    Storage::disk('public')->delete($path);
                }
            }
        });

        static::deleting(function ($record) {
            if ($record->c_image) {
                Storage::disk('public')->delete($record->c_image);
            }
            if ($record->main_logo) {
                Storage::disk('public')->delete($record->main_logo);
            }
            if ($record->collab_logo) {
                foreach ($record->collab_logo as $path) {
                    Storage::disk('public')->delete($path);
                }
            }
        });
    }
}
