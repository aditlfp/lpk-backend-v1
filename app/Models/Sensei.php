<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Sensei extends Model
{
    protected $connection = 'mysqlRecruitmen';
    protected $table = 'recruitmen.calon_sensei';

    public function scopeInActiveProgress(Builder $query): Builder
    {
        return $query->whereRelation('UserSensei', 'role', 'sensei')
                 ->whereRelation('UserSensei', 'status_akun', 'aktif');
    }

    public function UserSensei()
    {
        return $this->belongsTo(UserPetugasLapangan::class, 'user_id', 'id');
    }

    public function Document()
    {
        return $this->belongsTo(Dokumen::class, 'id', 'owner_id')->where('owner_type', 'sensei')->where('jenis_dokumen', 'Pas photo bebas rapi');
    }
}
