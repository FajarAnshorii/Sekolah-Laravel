<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AbsensiController extends Controller
{
    /**
     * Tampilkan daftar sesi absensi (dikelompokkan per tanggal + kelas)
     */
    public function index(Request $request)
    {
        $filter_tanggal = $request->get('tanggal');
        $filter_kelas   = $request->get('kelas');

        $query = Absensi::select(
                'tanggal',
                'kelas',
                DB::raw('COUNT(*) as total_siswa'),
                DB::raw('SUM(CASE WHEN status = "Hadir" THEN 1 ELSE 0 END) as jumlah_hadir'),
                DB::raw('SUM(poin) as total_poin')
            )
            ->groupBy('tanggal', 'kelas')
            ->orderByDesc('tanggal');

        if ($filter_tanggal) {
            $query->where('tanggal', $filter_tanggal);
        }
        if ($filter_kelas) {
            $query->where('kelas', $filter_kelas);
        }

        $sesi_absensi = $query->get();

        $kelas_options = Mahasiswa::distinct()->pluck('kelas')->filter()->toArray();

        return view('backend.absensi.index', compact(
            'sesi_absensi',
            'kelas_options',
            'filter_tanggal',
            'filter_kelas'
        ));
    }

    /**
     * Form tambah absensi baru
     */
    public function create(Request $request)
    {
        $kelas_options   = Mahasiswa::distinct()->pluck('kelas')->filter()->toArray();
        $selected_kelas  = $request->get('kelas');
        $selected_tanggal = $request->get('tanggal', date('Y-m-d'));

        $mahasiswa = collect();
        $existing  = collect();

        if ($selected_kelas) {
            $mahasiswa = Mahasiswa::where('kelas', $selected_kelas)
                ->where('status', 'Aktif')
                ->orderBy('nama')
                ->get();

            // Cek apakah sudah ada absensi untuk kelas + tanggal ini
            $existing = Absensi::where('kelas', $selected_kelas)
                ->where('tanggal', $selected_tanggal)
                ->pluck('status', 'mahasiswa_id');
        }

        return view('backend.absensi.create', compact(
            'kelas_options',
            'selected_kelas',
            'selected_tanggal',
            'mahasiswa',
            'existing'
        ));
    }

    /**
     * Simpan absensi bulk (satu sesi)
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'       => 'required|date',
            'kelas'         => 'required|string|max:100',
            'absensi'       => 'required|array|min:1',
            'absensi.*.mahasiswa_id' => 'required|exists:mahasiswas,id',
            'absensi.*.status'       => 'required|in:Hadir,Tidak Hadir,Izin,Sakit',
        ]);

        $tanggal = $request->tanggal;
        $kelas   = $request->kelas;

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
                        'kelas'       => $kelas,
                        'status'      => $status,
                        'poin'        => $poin,
                        'keterangan'  => $item['keterangan'] ?? null,
                        'inputted_by' => auth()->id(),
                    ]
                );
            }

            DB::commit();
            Session::flash('success', 'Absensi berhasil disimpan! Poin otomatis diberikan kepada siswa yang hadir.');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Gagal menyimpan absensi: ' . $e->getMessage());
        }

        return redirect()->route('backend-absensi.index');
    }

    /**
     * Detail sesi absensi (per tanggal + kelas)
     */
    public function show($id)
    {
        // $id = "tanggal__kelas" encoded sebagai base64
        $decoded = base64_decode($id);
        [$tanggal, $kelas] = explode('|', $decoded, 2);

        $absensi_list = Absensi::with('mahasiswa')
            ->where('tanggal', $tanggal)
            ->where('kelas', $kelas)
            ->orderBy('mahasiswa_id')
            ->get();

        $jumlah_hadir  = $absensi_list->where('status', 'Hadir')->count();
        $jumlah_izin   = $absensi_list->where('status', 'Izin')->count();
        $jumlah_sakit  = $absensi_list->where('status', 'Sakit')->count();
        $jumlah_alfa   = $absensi_list->where('status', 'Tidak Hadir')->count();
        $total_poin    = $absensi_list->sum('poin');

        return view('backend.absensi.show', compact(
            'absensi_list',
            'tanggal',
            'kelas',
            'jumlah_hadir',
            'jumlah_izin',
            'jumlah_sakit',
            'jumlah_alfa',
            'total_poin'
        ));
    }

    /**
     * Rekap poin absensi per siswa
     */
    public function rekap(Request $request)
    {
        $kelas_options  = Mahasiswa::distinct()->pluck('kelas')->filter()->toArray();
        $selected_kelas = $request->get('kelas');

        $query = Mahasiswa::withCount([
                'absensis as total_hadir' => function ($q) {
                    $q->where('status', 'Hadir');
                },
                'absensis as total_izin' => function ($q) {
                    $q->where('status', 'Izin');
                },
                'absensis as total_sakit' => function ($q) {
                    $q->where('status', 'Sakit');
                },
                'absensis as total_alfa' => function ($q) {
                    $q->where('status', 'Tidak Hadir');
                },
            ])
            ->withSum('absensis', 'poin')
            ->where('status', 'Aktif');

        if ($selected_kelas) {
            $query->where('kelas', $selected_kelas);
        }

        $mahasiswa = $query->orderByDesc('absensis_sum_poin')->get();

        return view('backend.absensi.rekap', compact('mahasiswa', 'kelas_options', 'selected_kelas'));
    }

    public function edit($id) { abort(404); }
    public function update(Request $request, $id) { abort(404); }
    public function destroy($id) { abort(404); }
}
