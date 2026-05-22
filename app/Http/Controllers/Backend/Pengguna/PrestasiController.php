<?php

namespace App\Http\Controllers\Backend\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Penghargaan;
use App\Models\Sertifikat;
use App\Models\Perlombaan;
use App\Models\Portofolio;

class PrestasiController extends Controller
{
    public function overview()
    {
        $students = Mahasiswa::with(['penghargaans', 'sertifikats', 'perlombaans', 'portofolios', 'absensis'])->get();

        // Sort students by total_poin descending
        $sorted = $students->sortByDesc(function ($student) {
            return $student->total_poin;
        });

        // Assign ranks (handles ties correctly)
        $rank = 1;
        $prev_poin = null;
        $ranked_students = [];
        $i = 1;
        foreach ($sorted as $student) {
            if ($prev_poin !== null && $student->total_poin < $prev_poin) {
                $rank = $i;
            }
            $student->rank = $rank;
            $prev_poin = $student->total_poin;
            $ranked_students[] = $student;
            $i++;
        }

        $penghargaan_count = Penghargaan::count();
        $sertifikat_count = Sertifikat::count();
        $perlombaan_count = Perlombaan::count();
        $portofolio_count = Portofolio::count();

        return view('backend.pengguna.prestasi.overview', compact(
            'ranked_students',
            'penghargaan_count',
            'sertifikat_count',
            'perlombaan_count',
            'portofolio_count'
        ));
    }

    public function showDetail($id)
    {
        $mahasiswa = Mahasiswa::with(['penghargaans', 'sertifikats', 'perlombaans', 'portofolios'])->findOrFail($id);
        return view('backend.pengguna.prestasi.detail', compact('mahasiswa'));
    }
}
