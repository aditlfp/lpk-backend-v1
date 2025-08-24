<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiveKandidat extends Model
{
    protected $guarded = [];

    public function BestStudent()
    {
        return $this->belongsTo(BestStudent::class);
    }

    public function PetugasLap()
    {
        return $this->belongsTo(PetugasLapangan::class);
    }

    public function FieldOfficier()
    {
        return $this->belongsTo(FieldOfficiers::class);
    }
}
