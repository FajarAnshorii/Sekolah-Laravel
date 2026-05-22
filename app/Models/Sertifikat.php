<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikats';

    protected $fillable = [
        'mahasiswa_id',
        'nama_sertifikat',
        'tingkat',
        'penyelenggara',
        'tanggal',
        'jenis',
        'jumlah_jam',
        'file_sertifikat',
        'deskripsi',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
