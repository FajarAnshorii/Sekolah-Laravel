<?php

namespace App\Http\Controllers\Backend\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrestasiSertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = Sertifikat::with('mahasiswa')->get();
        return view('backend.pengguna.prestasi.sertifikat.index', compact('sertifikat'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::where('status', 'Aktif')->get();
        return view('backend.pengguna.prestasi.sertifikat.create', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'nama_sertifikat' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jenis' => 'required|string|max:100',
            'jumlah_jam' => 'required|integer|min:1',
            'file_sertifikat' => 'required|file|max:5120',
            'deskripsi' => 'nullable|string',
        ]);

        $fileName = null;
        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/files/prestasi', $fileName);
        }

        Sertifikat::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'nama_sertifikat' => $request->nama_sertifikat,
            'tingkat' => $request->tingkat,
            'penyelenggara' => $request->penyelenggara,
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'jumlah_jam' => $request->jumlah_jam,
            'file_sertifikat' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Sertifikat Berhasil ditambah !');
        return redirect()->route('backend-prestasi-sertifikat.index');
    }

    public function edit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        $mahasiswa = Mahasiswa::where('status', 'Aktif')->get();
        return view('backend.pengguna.prestasi.sertifikat.edit', compact('sertifikat', 'mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $sertifikat = Sertifikat::findOrFail($id);

        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'nama_sertifikat' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jenis' => 'required|string|max:100',
            'jumlah_jam' => 'required|integer|min:1',
            'file_sertifikat' => 'nullable|file|max:5120',
            'deskripsi' => 'nullable|string',
        ]);

        $fileName = $sertifikat->file_sertifikat;
        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/files/prestasi', $fileName);
        }

        $sertifikat->update([
            'mahasiswa_id' => $request->mahasiswa_id,
            'nama_sertifikat' => $request->nama_sertifikat,
            'tingkat' => $request->tingkat,
            'penyelenggara' => $request->penyelenggara,
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'jumlah_jam' => $request->jumlah_jam,
            'file_sertifikat' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Sertifikat Berhasil diubah !');
        return redirect()->route('backend-prestasi-sertifikat.index');
    }

    public function destroy($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        $sertifikat->delete();

        Session::flash('success', 'Sertifikat Berhasil dihapus !');
        return redirect()->route('backend-prestasi-sertifikat.index');
    }
}
