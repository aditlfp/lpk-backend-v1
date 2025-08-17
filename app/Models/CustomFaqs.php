<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomFaqs extends Model
{
    protected $fillable = [
        'title',
        'desc'
    ];
}
