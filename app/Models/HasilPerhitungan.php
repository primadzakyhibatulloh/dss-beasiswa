<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilPerhitungan extends Model
{
    protected $table = 'hasil_perhitungan';

    protected $fillable = [
        'nama_peserta',
        'kriteria_id',
        'sub_kriteria_id',
        'nilai_subkriteria',
        'nilai_ideal',
        'nilai_gap',
        'nilai_bobot',
        'nilai_cf',
        'nilai_sf',
        'nilai_total',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function sub_kriteria()
    {
        return $this->belongsTo(SubKriteria::class, 'sub_kriteria_id');
    }

    // Accessor untuk deskripsi sub kriteria berdasarkan sub_kriteria_id
    public function getDeskripsiSubKriteriaAttribute()
    {
        return $this->sub_kriteria ? $this->sub_kriteria->deskripsi : '-';
    }
}
