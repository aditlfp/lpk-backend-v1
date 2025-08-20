<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetBestStudent extends Model
{
    protected $fillable = [
        'best_student_id',
        'is_best'
    ];
}
