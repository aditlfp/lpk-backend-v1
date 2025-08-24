<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class BestStudent extends Model
{
    use HasFactory;
    protected $connection = 'mysqlRecruitmen';
    protected $table = 'calon_siswa';
    protected $fillable = ['calon_siswa_id', 'nama_lengkap'];

    public function scopeInActiveProgress(Builder $query): Builder
    {
        return $query->where(function (Builder $subQuery) {
            $statuses = [
                'Penempatan',
                'Pengurusan Visa',
                'Pemberangkatan',
                'Menunggu Job',
            ];

            $subQuery->whereIn('status_progress', $statuses)
                    ->orWhere('status_progress', 'LIKE', '%Pendidikan%');
        });
    }

    public function SetBestStudent()
    {
        return $this->hasOne(SetBestStudent::class);
    }

    public function getUmurAttribute()
    {
        return $this->tanggal_lahir != null ? Carbon::parse($this->tanggal_lahir)->age . " (Tahun)" : "Umur Tidak Diketahui";
    }

    public function Document()
    {
        return $this->belongsTo(Dokumen::class, 'id', 'owner_id')->where('owner_type', 'siswa')->where('jenis_dokumen', 'Pas Foto Formal');
    }
}
