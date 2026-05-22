<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';

    protected $fillable = [
        'mahasiswa_id',
        'tanggal',
        'kelas',
        'status',
        'poin',
        'keterangan',
        'inputted_by',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi ke Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    /**
     * Relasi ke User (komting atau admin yang menginput)
     */
    public function inputtedBy()
    {
        return $this->belongsTo(User::class, 'inputted_by');
    }

    /**
     * Boot: hitung poin otomatis berdasarkan status
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->status === 'Hadir') {
                $model->poin = 5;
            } elseif ($model->status === 'Sakit') {
                $model->poin = 3;
            } elseif ($model->status === 'Izin') {
                $model->poin = 2;
            } else {
                $model->poin = 0;
            }
        });
    }
}
