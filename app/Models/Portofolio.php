<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    protected $table = 'portofolios';

    protected $fillable = [
        'mahasiswa_id',
        'judul',
        'kategori',
        'link',
        'tanggal',
        'file_portofolio',
        'deskripsi',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
