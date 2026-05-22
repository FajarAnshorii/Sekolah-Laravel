<?php

namespace App\Http\Controllers\Backend\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Penghargaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrestasiPenghargaanController extends Controller
{
    public function index()
    {
        $penghargaan = Penghargaan::with('mahasiswa')->get();
        return view('backend.pengguna.prestasi.penghargaan.index', compact('penghargaan'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::where('status', 'Aktif')->get();
        return view('backend.pengguna.prestasi.penghargaan.create', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'nama_penghargaan' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255',
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

        Penghargaan::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'nama_penghargaan' => $request->nama_penghargaan,
            'tingkat' => $request->tingkat,
            'penyelenggara' => $request->penyelenggara,
            'tanggal' => $request->tanggal,
            'file_sertifikat' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Penghargaan Berhasil ditambah !');
        return redirect()->route('backend-prestasi-penghargaan.index');
    }

    public function edit($id)
    {
        $penghargaan = Penghargaan::findOrFail($id);
        $mahasiswa = Mahasiswa::where('status', 'Aktif')->get();
        return view('backend.pengguna.prestasi.penghargaan.edit', compact('penghargaan', 'mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $penghargaan = Penghargaan::findOrFail($id);

        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'nama_penghargaan' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file_sertifikat' => 'nullable|file|max:5120',
            'deskripsi' => 'nullable|string',
        ]);

        $fileName = $penghargaan->file_sertifikat;
        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/files/prestasi', $fileName);
        }

        $penghargaan->update([
            'mahasiswa_id' => $request->mahasiswa_id,
            'nama_penghargaan' => $request->nama_penghargaan,
            'tingkat' => $request->tingkat,
            'penyelenggara' => $request->penyelenggara,
            'tanggal' => $request->tanggal,
            'file_sertifikat' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Penghargaan Berhasil diubah !');
        return redirect()->route('backend-prestasi-penghargaan.index');
    }

    public function destroy($id)
    {
        $penghargaan = Penghargaan::findOrFail($id);
        $penghargaan->delete();

        Session::flash('success', 'Penghargaan Berhasil dihapus !');
        return redirect()->route('backend-prestasi-penghargaan.index');
    }
}
