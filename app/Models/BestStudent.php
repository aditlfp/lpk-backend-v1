<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestStudent extends Model
{
    use HasFactory;
    protected $fillable = ['calon_siswa_id', 'nama_lengkap'];
}
