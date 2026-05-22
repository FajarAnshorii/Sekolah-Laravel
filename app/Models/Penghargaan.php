<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghargaan extends Model
{
    use HasFactory;

    protected $table = 'penghargaans';

    protected $fillable = [
        'mahasiswa_id',
        'nama_penghargaan',
        'tingkat',
        'penyelenggara',
        'tanggal',
        'file_sertifikat',
        'deskripsi',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
