<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $fillable = [
        'npm',
        'kode_matakuliah',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'npm', 'npm');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_matakuliah', 'kode_matakuliah');
    }
}
