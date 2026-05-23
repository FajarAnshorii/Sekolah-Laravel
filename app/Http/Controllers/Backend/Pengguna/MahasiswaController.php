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
        $prodi_kelas_map = $this->getProdiKelasMap();
        $selected_prodi = $request->get('program_studi');
        $selected_kelas = $request->get('kelas');

        $query = Mahasiswa::query();
        if ($selected_prodi) {
            $query->where('program_studi', $selected_prodi);
        }
        if ($selected_kelas) {
            $query->where('kelas', $selected_kelas);
        }
        $mahasiswa = $query->get();

        return view('backend.pengguna.mahasiswa.index', compact(
            'mahasiswa', 
            'prodi_kelas_map', 
            'selected_prodi', 
            'selected_kelas'
        ));
    }

    public function create()
    {
        $prodi_kelas_map = $this->getProdiKelasMap();
        return view('backend.pengguna.mahasiswa.create', compact('prodi_kelas_map'));
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
        $prodi_kelas_map = $this->getProdiKelasMap();
        return view('backend.pengguna.mahasiswa.edit', compact('mahasiswa', 'prodi_kelas_map'));
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

    protected function getProdiKelasMap()
    {
        return [
            'S1 Keperawatan' => [
                'Kelas 1',
                'Kelas 2',
                'Tingkat 1 A',
                'Tingkat 1 B',
                'Tingkat 1 C',
                'Tingkat 1 D',
                'Tingkat 2 A',
                'Tingkat 2 B',
                'Tingkat 2 C',
                'Tingkat 3 A',
                'Tingkat 3 B'
            ],
            'Profesi Ners' => [
                'Profesi Ners'
            ],
            'D3 Keperawatan' => [
                'Tingkat 1',
                'Tingkat 2 A',
                'Tingkat 2 B',
                'Tingkat 3'
            ],
            'D4 MIK' => [
                'D4 MIK'
            ],
            'S1 Gizi' => [
                'S1 Gizi'
            ],
            'Teknik Informatika' => [
                'Kelas 1',
                'Kelas 2'
            ]
        ];
    }
}
