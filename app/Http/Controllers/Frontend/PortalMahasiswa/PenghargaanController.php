<?php

namespace App\Http\Controllers\Frontend\PortalMahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Penghargaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PenghargaanController extends Controller
{
    public function index()
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $penghargaan = Penghargaan::where('mahasiswa_id', $studentId)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('frontend.portal-mahasiswa.penghargaan.index', compact('penghargaan'));
    }

    public function create()
    {
        return view('frontend.portal-mahasiswa.penghargaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penghargaan' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file_sertifikat' => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
            'deskripsi' => 'nullable|string',
        ]);

        $studentId = Session::get('portal_mahasiswa_id');
        $fileName = null;

        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $fileName = time() . "_" . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/files/prestasi', $fileName);
        }

        Penghargaan::create([
            'mahasiswa_id' => $studentId,
            'nama_penghargaan' => $request->nama_penghargaan,
            'tingkat' => $request->tingkat,
            'penyelenggara' => $request->penyelenggara,
            'tanggal' => $request->tanggal,
            'file_sertifikat' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Penghargaan Anda berhasil ditambahkan!');
        return redirect()->route('portal-mahasiswa.penghargaan.index');
    }

    public function show($id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $penghargaan = Penghargaan::where('mahasiswa_id', $studentId)->findOrFail($id);
        return view('frontend.portal-mahasiswa.penghargaan.show', compact('penghargaan'));
    }

    public function edit($id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $penghargaan = Penghargaan::where('mahasiswa_id', $studentId)->findOrFail($id);
        return view('frontend.portal-mahasiswa.penghargaan.edit', compact('penghargaan'));
    }

    public function update(Request $request, $id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $penghargaan = Penghargaan::where('mahasiswa_id', $studentId)->findOrFail($id);

        $request->validate([
            'nama_penghargaan' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file_sertifikat' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
            'deskripsi' => 'nullable|string',
        ]);

        $fileName = $penghargaan->file_sertifikat;
        if ($request->hasFile('file_sertifikat')) {
            // Delete old file if exists
            if ($penghargaan->file_sertifikat) {
                Storage::delete('public/files/prestasi/' . $penghargaan->file_sertifikat);
            }
            $file = $request->file('file_sertifikat');
            $fileName = time() . "_" . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/files/prestasi', $fileName);
        }

        $penghargaan->update([
            'nama_penghargaan' => $request->nama_penghargaan,
            'tingkat' => $request->tingkat,
            'penyelenggara' => $request->penyelenggara,
            'tanggal' => $request->tanggal,
            'file_sertifikat' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Penghargaan Anda berhasil diperbarui!');
        return redirect()->route('portal-mahasiswa.penghargaan.index');
    }

    public function destroy($id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $penghargaan = Penghargaan::where('mahasiswa_id', $studentId)->findOrFail($id);

        // Delete associated file
        if ($penghargaan->file_sertifikat) {
            Storage::delete('public/files/prestasi/' . $penghargaan->file_sertifikat);
        }

        $penghargaan->delete();

        Session::flash('success', 'Penghargaan Anda berhasil dihapus!');
        return redirect()->route('portal-mahasiswa.penghargaan.index');
    }
}
