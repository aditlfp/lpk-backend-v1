<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiveKandidat extends Model
{
    protected $guarded = [];
    protected $connection = 'mysql';

    public function BestStudent()
    {
        return $this->belongsTo(BestStudent::class, 'best_student_id', 'id');
    }

    public function PetugasLap()
    {
        return $this->belongsTo(PetugasLapangan::class, 'field_officiers_id', 'id');
    }

    public function Sensei()
    {
        return $this->belongsTo(Sensei::class, 'sensei_id', 'id');
    }
}
