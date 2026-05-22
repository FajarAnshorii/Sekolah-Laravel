<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perlombaan extends Model
{
    use HasFactory;

    protected $table = 'perlombaans';

    protected $fillable = [
        'mahasiswa_id',
        'nama_perlombaan',
        'tingkat',
        'penyelenggara',
        'juara',
        'tanggal',
        'file_sertifikat',
        'deskripsi',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
