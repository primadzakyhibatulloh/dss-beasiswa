<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';

    protected $fillable = [
        'kode',
        'nama',
        'faktor',
        'bobot',
        'nilai_ideal',
    ];

    public function sub_kriteria()
    {
        return $this->hasMany(SubKriteria::class, 'kriteria_id');
    }

    public function hasilPerhitungan()
    {
        return $this->hasMany(HasilPerhitungan::class, 'kriteria_id');
    }
}
