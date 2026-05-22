<?php

namespace App\Http\Controllers\Backend\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Perlombaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrestasiPerlombaanController extends Controller
{
    public function index()
    {
        $perlombaan = Perlombaan::with('mahasiswa')->get();
        return view('backend.pengguna.prestasi.perlombaan.index', compact('perlombaan'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::where('status', 'Aktif')->get();
        return view('backend.pengguna.prestasi.perlombaan.create', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'nama_perlombaan' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255',
            'juara' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'file_sertifikat' => 'required|file|max:5120',
            'deskripsi' => 'nullable|string',
        ]);

        $fileName = null;
        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/files/prestasi', $fileName);
        }

        Perlombaan::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'nama_perlombaan' => $request->nama_perlombaan,
            'tingkat' => $request->tingkat,
            'penyelenggara' => $request->penyelenggara,
            'juara' => $request->juara,
            'tanggal' => $request->tanggal,
            'file_sertifikat' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Perlombaan Berhasil ditambah !');
        return redirect()->route('backend-prestasi-perlombaan.index');
    }

    public function edit($id)
    {
        $perlombaan = Perlombaan::findOrFail($id);
        $mahasiswa = Mahasiswa::where('status', 'Aktif')->get();
        return view('backend.pengguna.prestasi.perlombaan.edit', compact('perlombaan', 'mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $perlombaan = Perlombaan::findOrFail($id);

        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'nama_perlombaan' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255',
            'juara' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'file_sertifikat' => 'nullable|file|max:5120',
            'deskripsi' => 'nullable|string',
        ]);

        $fileName = $perlombaan->file_sertifikat;
        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/files/prestasi', $fileName);
        }

        $perlombaan->update([
            'mahasiswa_id' => $request->mahasiswa_id,
            'nama_perlombaan' => $request->nama_perlombaan,
            'tingkat' => $request->tingkat,
            'penyelenggara' => $request->penyelenggara,
            'juara' => $request->juara,
            'tanggal' => $request->tanggal,
            'file_sertifikat' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Perlombaan Berhasil diubah !');
        return redirect()->route('backend-prestasi-perlombaan.index');
    }

    public function destroy($id)
    {
        $perlombaan = Perlombaan::findOrFail($id);
        $perlombaan->delete();

        Session::flash('success', 'Perlombaan Berhasil dihapus !');
        return redirect()->route('backend-prestasi-perlombaan.index');
    }
}
