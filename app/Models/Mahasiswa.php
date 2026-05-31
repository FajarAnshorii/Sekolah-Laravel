<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';

    protected $fillable = [
        'nama',
        'nim',
        'program_studi',
        'kelas',
        'email',
        'no_hp',
        'status',
        'foto_profile',
        'k1',
        'k2',
        'k3',
        'k4',
        'mid',
        'uas',
        'remidi',
        'total',
        'nilai_akhir',
        'bobot_nilai',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $k1 = floatval($model->k1 ?? 0);
            $k2 = floatval($model->k2 ?? 0);
            $k3 = floatval($model->k3 ?? 0);
            $k4 = floatval($model->k4 ?? 0);
            $mid = floatval($model->mid ?? 0);
            $uas = floatval($model->uas ?? 0);
            $remidi = floatval($model->remidi ?? 0);

            // Formula: (K1 * 0.10) + (K2 * 0.00) + (K3 * 0.45) + (K4 * 0.00) + (MID * 0.20) + (UAS * 0.25)
            $total = ($k1 * 0.10) + ($k2 * 0.00) + ($k3 * 0.45) + ($k4 * 0.00) + ($mid * 0.20) + ($uas * 0.25);

            if ($remidi > 0) {
                $total = $remidi;
            }

            $model->total = round($total, 4);

            // Scale mapping:
            // A  : >= 80.0 (4.0)
            // A- : >= 77.0 (3.7)
            // B+ : >= 74.0 (3.3)
            // B  : >= 70.0 (3.0)
            // B- : >= 65.0 (2.7)
            // C  : >= 60.0 (2.0)
            // D  : >= 50.0 (1.0)
            // E  : < 50.0 (0.0)
            if ($model->total >= 80.0) {
                $model->nilai_akhir = 'A';
                $model->bobot_nilai = 4.0;
            } elseif ($model->total >= 77.0) {
                $model->nilai_akhir = 'A-';
                $model->bobot_nilai = 3.7;
            } elseif ($model->total >= 74.0) {
                $model->nilai_akhir = 'B+';
                $model->bobot_nilai = 3.3;
            } elseif ($model->total >= 70.0) {
                $model->nilai_akhir = 'B';
                $model->bobot_nilai = 3.0;
            } elseif ($model->total >= 65.0) {
                $model->nilai_akhir = 'B-';
                $model->bobot_nilai = 2.7;
            } elseif ($model->total >= 60.0) {
                $model->nilai_akhir = 'C';
                $model->bobot_nilai = 2.0;
            } elseif ($model->total >= 50.0) {
                $model->nilai_akhir = 'D';
                $model->bobot_nilai = 1.0;
            } else {
                $model->nilai_akhir = 'E';
                $model->bobot_nilai = 0.0;
            }
        });
    }

    public function penghargaans()
    {
        return $this->hasMany(Penghargaan::class, 'mahasiswa_id');
    }

    public function sertifikats()
    {
        return $this->hasMany(Sertifikat::class, 'mahasiswa_id');
    }

    public function perlombaans()
    {
        return $this->hasMany(Perlombaan::class, 'mahasiswa_id');
    }

    public function portofolios()
    {
        return $this->hasMany(Portofolio::class, 'mahasiswa_id');
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'mahasiswa_id');
    }

    public function getTotalPoinAttribute()
    {
        return $this->getPoinPrestasiAttribute() + $this->getPoinAbsensiAttribute();
    }

    public function getPoinPrestasiAttribute()
    {
        $poin = 0;

        // Penghargaan
        foreach ($this->penghargaans as $p) {
            $poin += $this->calculatePoin($p->tingkat);
        }

        // Sertifikat
        foreach ($this->sertifikats as $s) {
            $poin += $this->calculatePoin($s->tingkat);
        }

        // Perlombaan
        foreach ($this->perlombaans as $l) {
            $poin += $this->calculatePoin($l->tingkat);
        }

        return $poin;
    }

    public function getPoinAbsensiAttribute()
    {
        // Jika relasi sudah di-load, gunakan collection; jika tidak, query langsung
        if ($this->relationLoaded('absensis')) {
            return $this->absensis->sum('poin');
        }
        return $this->absensis()->sum('poin');
    }

    private function calculatePoin($tingkat)
    {
        switch (strtolower(trim($tingkat))) {
            case 'nasional':
                return 25;
            case 'provinsi':
                return 20;
            case 'kabupaten/kota':
            case 'kabupaten':
            case 'kota':
                return 15;
            case 'universitas':
                return 10;
            default:
                return 0;
        }
    }
}
