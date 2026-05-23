<?php

namespace App\Http\Controllers\Backend\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $kelas_options = $this->getKelasOptions();
        
        // Merge with any other distinct classes in DB just in case
        $db_kelas = Mahasiswa::distinct()->pluck('kelas')->filter()->toArray();
        $kelas_options = array_values(array_unique(array_merge($kelas_options, $db_kelas)));

        $selected_kelas = $request->get('kelas');

        $query = Mahasiswa::query();
        if ($selected_kelas) {
            $query->where('kelas', $selected_kelas);
        }
        $mahasiswa = $query->get();

        return view('backend.pengguna.mahasiswa.index', compact('mahasiswa', 'kelas_options', 'selected_kelas'));
    }

    public function create()
    {
        $kelas_options = $this->getKelasOptions();
        $prodi_options = $this->getProdiOptions();
        return view('backend.pengguna.mahasiswa.create', compact('kelas_options', 'prodi_options'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:mahasiswas,nim',
            'program_studi' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:mahasiswas,email',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'k1' => 'nullable|numeric|min:0|max:100',
            'k2' => 'nullable|numeric|min:0|max:100',
            'k3' => 'nullable|numeric|min:0|max:100',
            'k4' => 'nullable|numeric|min:0|max:100',
            'mid' => 'nullable|numeric|min:0|max:100',
            'uas' => 'nullable|numeric|min:0|max:100',
            'remidi' => 'nullable|numeric|min:0|max:100',
        ]);

        Mahasiswa::create($request->all());

        Session::flash('success', 'Mahasiswa Berhasil ditambah !');
        return redirect()->route('backend-pengguna-mahasiswa.index');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $kelas_options = $this->getKelasOptions();
        $prodi_options = $this->getProdiOptions();
        return view('backend.pengguna.mahasiswa.edit', compact('mahasiswa', 'kelas_options', 'prodi_options'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:mahasiswas,nim,' . $id,
            'program_studi' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:mahasiswas,email,' . $id,
            'no_hp' => 'nullable|string|max:20',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'k1' => 'nullable|numeric|min:0|max:100',
            'k2' => 'nullable|numeric|min:0|max:100',
            'k3' => 'nullable|numeric|min:0|max:100',
            'k4' => 'nullable|numeric|min:0|max:100',
            'mid' => 'nullable|numeric|min:0|max:100',
            'uas' => 'nullable|numeric|min:0|max:100',
            'remidi' => 'nullable|numeric|min:0|max:100',
        ]);

        $mahasiswa->update($request->all());

        Session::flash('success', 'Mahasiswa Berhasil diubah !');
        return redirect()->route('backend-pengguna-mahasiswa.index');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        Session::flash('success', 'Mahasiswa Berhasil dihapus !');
        return redirect()->route('backend-pengguna-mahasiswa.index');
    }

    protected function getKelasOptions()
    {
        return [
            // S1 Keperawatan (Current seeded)
            'Kelas 1',
            'Kelas 2',
            
            // Profesi Ners
            'Profesi Ners',
            
            // S1 Keperawatan (Planned)
            'S1 Keperawatan - Tingkat 1 A',
            'S1 Keperawatan - Tingkat 1 B',
            'S1 Keperawatan - Tingkat 1 C',
            'S1 Keperawatan - Tingkat 1 D',
            'S1 Keperawatan - Tingkat 2 A',
            'S1 Keperawatan - Tingkat 2 B',
            'S1 Keperawatan - Tingkat 2 C',
            'S1 Keperawatan - Tingkat 3 A',
            'S1 Keperawatan - Tingkat 3 B',
            
            // D3 Keperawatan
            'D3 Keperawatan - Tingkat 1',
            'D3 Keperawatan - Tingkat 2 A',
            'D3 Keperawatan - Tingkat 2 B',
            'D3 Keperawatan - Tingkat 3',
            
            // D4 MIK
            'D4 MIK',
            
            // S1 Gizi
            'S1 Gizi'
        ];
    }

    protected function getProdiOptions()
    {
        return [
            'S1 Keperawatan' => 'S1 Keperawatan',
            'Profesi Ners' => 'Profesi Ners',
            'D3 Keperawatan' => 'D3 Keperawatan',
            'D4 MIK' => 'D4 MIK',
            'S1 Gizi' => 'S1 Gizi',
            'Teknik Informatika' => 'Teknik Informatika' // support existing
        ];
    }
}
