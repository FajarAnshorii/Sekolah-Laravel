<?php

namespace App\Http\Controllers\Komting;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\KomtingKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KomtingDashboardController extends Controller
{
    /**
     * Tampilkan halaman utama dashboard komting
     */
    public function dashboard()
    {
        $user = Auth::user();
        $komtingKelas = $user->komtingKelas;
        $kelas = $komtingKelas->kelas;

        $totalSiswa = Mahasiswa::where('kelas', $kelas)->where('status', 'Aktif')->count();
        $totalSesi  = Absensi::where('kelas', $kelas)->distinct('tanggal')->count('tanggal');
        $totalPoin  = Absensi::where('kelas', $kelas)->sum('poin');

        // Mengambil rekap kehadiran
        $rekapKehadiran = Absensi::select(
                'status',
                DB::raw('COUNT(*) as total')
            )
            ->where('kelas', $kelas)
            ->groupBy('status')
            ->get()
            ->pluck('total', 'status');

        return view('komting.dashboard', compact('user', 'kelas', 'totalSiswa', 'totalSesi', 'totalPoin', 'rekapKehadiran'));
    }

    /**
     * Tampilkan form input absensi kelas yang ditugaskan
     */
    public function absensi(Request $request)
    {
        $user = Auth::user();
        $kelas = $user->komtingKelas->kelas;
        $selected_tanggal = $request->get('tanggal', date('Y-m-d'));

        // Ambil semua mahasiswa aktif di kelas yang ditugaskan
        $mahasiswa = Mahasiswa::where('kelas', $kelas)
            ->where('status', 'Aktif')
            ->orderBy('nama')
            ->get();

        // Ambil data absensi yang sudah ada untuk kelas + tanggal ini
        $existing = Absensi::where('kelas', $kelas)
            ->where('tanggal', $selected_tanggal)
            ->pluck('status', 'mahasiswa_id');

        return view('komting.absensi', compact('kelas', 'selected_tanggal', 'mahasiswa', 'existing'));
    }

    /**
     * Simpan absensi kelas
     */
    public function storeAbsensi(Request $request)
    {
        $user = Auth::user();
        $assigned_kelas = $user->komtingKelas->kelas;

        $request->validate([
            'tanggal'       => 'required|date',
            'kelas'         => 'required|string|max:100',
            'absensi'       => 'required|array|min:1',
            'absensi.*.mahasiswa_id' => 'required|exists:mahasiswas,id',
            'absensi.*.status'       => 'required|in:Hadir,Tidak Hadir,Izin,Sakit',
        ]);

        $tanggal = $request->tanggal;
        $kelas   = $request->kelas;

        // Validasi: Pastikan kelas yang dikirim cocok dengan kelas komting
        if ($kelas !== $assigned_kelas) {
            Session::flash('error', 'Akses ditolak. Anda hanya diperbolehkan menginput absensi untuk kelas ' . $assigned_kelas . '.');
            return redirect()->back();
        }

        // Validasi: Pastikan semua mahasiswa_id memang milik kelas komting
        $mahasiswa_ids = collect($request->absensi)->pluck('mahasiswa_id')->toArray();
        $valid_count = Mahasiswa::whereIn('id', $mahasiswa_ids)->where('kelas', $assigned_kelas)->count();
        if ($valid_count !== count($mahasiswa_ids)) {
            Session::flash('error', 'Akses ditolak. Ditemukan siswa yang tidak terdaftar di kelas Anda.');
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            foreach ($request->absensi as $item) {
                $status = $item['status'];
                $poin = 0;
                if ($status === 'Hadir') {
                    $poin = 5;
                } elseif ($status === 'Sakit') {
                    $poin = 3;
                } elseif ($status === 'Izin') {
                    $poin = 2;
                }

                Absensi::updateOrCreate(
                    [
                        'mahasiswa_id' => $item['mahasiswa_id'],
                        'tanggal'      => $tanggal,
                    ],
                    [
                        'kelas'       => $assigned_kelas,
                        'status'      => $status,
                        'poin'        => $poin,
                        'keterangan'  => $item['keterangan'] ?? null,
                        'inputted_by' => $user->id,
                    ]
                );
            }

            DB::commit();
            Session::flash('success', 'Absensi kelas ' . $assigned_kelas . ' tanggal ' . date('d-m-Y', strtotime($tanggal)) . ' berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Gagal menyimpan absensi: ' . $e->getMessage());
        }

        return redirect()->route('komting.riwayat');
    }

    /**
     * Tampilkan riwayat absensi untuk kelas komting
     */
    public function riwayat()
    {
        $user = Auth::user();
        $kelas = $user->komtingKelas->kelas;

        $riwayat = Absensi::select(
                'tanggal',
                'kelas',
                DB::raw('COUNT(*) as total_siswa'),
                DB::raw('SUM(CASE WHEN status = "Hadir" THEN 1 ELSE 0 END) as jumlah_hadir'),
                DB::raw('SUM(CASE WHEN status = "Sakit" THEN 1 ELSE 0 END) as jumlah_sakit'),
                DB::raw('SUM(CASE WHEN status = "Izin" THEN 1 ELSE 0 END) as jumlah_izin'),
                DB::raw('SUM(CASE WHEN status = "Tidak Hadir" THEN 1 ELSE 0 END) as jumlah_alfa'),
                DB::raw('SUM(poin) as total_poin')
            )
            ->where('kelas', $kelas)
            ->groupBy('tanggal', 'kelas')
            ->orderByDesc('tanggal')
            ->get();

        return view('komting.riwayat', compact('kelas', 'riwayat'));
    }
}
