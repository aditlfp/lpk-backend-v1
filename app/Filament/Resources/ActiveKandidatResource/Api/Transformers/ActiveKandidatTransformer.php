<?php
namespace App\Filament\Resources\ActiveKandidatResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ActiveKandidat;

/**
 * @property ActiveKandidat $resource
 */
class ActiveKandidatTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'best_student' => $this->bestStudent ? [
                'id' => $this->bestStudent->id,
                'nama_lengkap' => $this->bestStudent->nama_lengkap,
                'alamat' => $this->bestStudent->alamat,
                'status_progress' => $this->bestStudent->status_progress,
                'tahun_lulus' => $this->bestStudent->tahun_lulus,
                'document' => $this->bestStudent->document,
            ] : null,
            'field_officiers' => $this->petugasLap ? [
                'id' => $this->petugasLap->id,
                'nama_lengkap' => $this->petugasLap->nama_lengkap,
                'misi' => $this->petugasLap->misi,
                'visi' => $this->petugasLap->visi,
                'performance_rating' => $this->petugasLap->performance_rating,
                'area_penugasan' => $this->petugasLap->area_penugasan,
                'document' => $this->petugasLap->document,
            ] : null,
            'sensei' => $this->sensei ? [
                'id' => $this->sensei->id,
                'nama_lengkap' => $this->sensei->nama_lengkap,
                'pengalaman' => $this->sensei->pengalaman,
                'alamat' => $this->sensei->alamat,
                'hobi' => $this->sensei->hobi,
                'keunggulan_diri' => $this->sensei->keunggulan_diri,
                'document' => $this->sensei->document,

            ] : null,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
