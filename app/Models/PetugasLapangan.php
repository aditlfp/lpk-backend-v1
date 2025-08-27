<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PetugasLapangan extends Model
{
    protected $connection = 'mysqlRecruitmen';
    protected $table = 'recruitmen_v2.calon_petugas_lapangan';

    public function scopeInActiveProgress(Builder $query): Builder
    {
        return $query->whereRelation('UserPL', 'role', 'petugas_lapangan')
                 ->whereRelation('UserPL', 'status_akun', 'aktif');
    }

    public function UserPL()
    {
        return $this->belongsTo(UserPetugasLapangan::class, 'user_id', 'id');
    }

    public function Document()
    {
        return $this->belongsTo(Dokumen::class, 'id', 'owner_id')->where('owner_type', 'petugas_lapangan')->where('jenis_dokumen', 'Foto diri formal');
    }
}
