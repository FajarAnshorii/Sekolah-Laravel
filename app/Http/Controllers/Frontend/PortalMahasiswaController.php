<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PortalMahasiswaController extends Controller
{
    public function showLogin()
    {
        if (Session::has('portal_mahasiswa_id')) {
            return redirect()->route('portal-mahasiswa.dashboard');
        }
        return view('frontend.portal-mahasiswa.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = trim($request->username);
        $password = trim($request->password);

        $student = Mahasiswa::whereRaw('LOWER(nama) = ?', [strtolower($username)])
            ->where('nim', $password)
            ->first();

        if (!$student) {
            return back()->withErrors([
                'login_error' => 'Nama Lengkap (Nama Pengguna) atau NIM (Kata Sandi) yang Anda masukkan tidak terdaftar atau tidak sesuai.'
            ])->withInput();
        }

        if (strtolower(trim($student->status)) !== 'aktif') {
            return back()->withErrors([
                'login_error' => 'Status akun Mahasiswa Anda tidak aktif. Silakan hubungi admin.'
            ])->withInput();
        }

        Session::put('portal_mahasiswa_id', $student->id);
        Session::put('portal_mahasiswa_nama', $student->nama);
        Session::flash('success', 'Selamat Datang kembali, ' . $student->nama . '!');

        return redirect()->route('portal-mahasiswa.dashboard');
    }

    public function dashboard()
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $student = Mahasiswa::with(['penghargaans', 'sertifikats', 'perlombaans', 'portofolios'])->findOrFail($studentId);

        // Fetch all active students to calculate Leaderboard Rank
        $allStudents = Mahasiswa::where('status', 'Aktif')->get()->sortByDesc(function ($s) {
            return $s->total_poin;
        })->values();

        $rank = 1;
        foreach ($allStudents as $index => $s) {
            if ($s->id === $student->id) {
                $rank = $index + 1;
                break;
            }
        }

        // Count categories coverage
        $categoriesCount = 0;
        $hasPenghargaan = $student->penghargaans->count() > 0;
        $hasSertifikat = $student->sertifikats->count() > 0;
        $hasPerlombaan = $student->perlombaans->count() > 0;
        $hasPortofolio = $student->portofolios->count() > 0;

        if ($hasPenghargaan) $categoriesCount++;
        if ($hasSertifikat) $categoriesCount++;
        if ($hasPerlombaan) $categoriesCount++;
        if ($hasPortofolio) $categoriesCount++;

        // Determine Superstar / Badge Title
        $badgeTitle = 'NEWCOMER';
        if ($categoriesCount === 4) {
            $badgeTitle = 'SUPERSTAR';
        } elseif ($categoriesCount === 3) {
            $badgeTitle = 'ELITE';
        } elseif ($categoriesCount === 2) {
            $badgeTitle = 'RISING STAR';
        } elseif ($categoriesCount === 1) {
            $badgeTitle = 'BEGINNER';
        }

        // Breakdown Point Calculations
        $poinPenghargaan = 0;
        foreach ($student->penghargaans as $p) {
            $poinPenghargaan += $this->calculateSinglePoin($p->tingkat);
        }

        $poinSertifikat = 0;
        foreach ($student->sertifikats as $s) {
            $poinSertifikat += $this->calculateSinglePoin($s->tingkat);
        }

        $poinPerlombaan = 0;
        foreach ($student->perlombaans as $l) {
            $poinPerlombaan += $this->calculateSinglePoin($l->tingkat);
        }

        $poinPortofolio = 0; // Portofolio is 0 points

        $totalPoin = $poinPenghargaan + $poinSertifikat + $poinPerlombaan;

        return view('frontend.portal-mahasiswa.dashboard', compact(
            'student',
            'rank',
            'categoriesCount',
            'badgeTitle',
            'poinPenghargaan',
            'poinSertifikat',
            'poinPerlombaan',
            'poinPortofolio',
            'totalPoin'
        ));
    }

    public function logout()
    {
        Session::forget('portal_mahasiswa_id');
        Session::forget('portal_mahasiswa_nama');
        Session::flash('success', 'Anda telah berhasil keluar dari Portal Mahasiswa.');
        return redirect()->route('portal-mahasiswa.login');
    }

    public function showProfile()
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $student = Mahasiswa::findOrFail($studentId);
        return view('frontend.portal-mahasiswa.profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $student = Mahasiswa::findOrFail($studentId);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:mahasiswas,email,' . $studentId,
            'no_hp' => 'nullable|string|max:20',
            'nim' => 'required|string|max:50|unique:mahasiswas,nim,' . $studentId,
            'foto_profile' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('foto_profile')) {
            // Delete old file if exists
            if ($student->foto_profile) {
                \Illuminate\Support\Facades\Storage::delete('public/images/profile/' . $student->foto_profile);
            }
            $file = $request->file('foto_profile');
            $fileName = time() . "_" . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/images/profile', $fileName);
            $student->foto_profile = $fileName;
        }

        $student->nama = $request->nama;
        $student->email = $request->email;
        $student->no_hp = $request->no_hp;
        $student->nim = $request->nim; // Updates NIM (which is used as the password)
        $student->save();

        // Update session name in case it changed
        Session::put('portal_mahasiswa_nama', $student->nama);

        Session::flash('success', 'Profil Anda berhasil diperbarui!');
        return redirect()->route('portal-mahasiswa.dashboard');
    }

    private function calculateSinglePoin($tingkat)
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
