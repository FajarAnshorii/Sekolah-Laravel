<?php

namespace App\Http\Controllers\Frontend\PortalMahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Perlombaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PerlombaanController extends Controller
{
    public function index()
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $perlombaan = Perlombaan::where('mahasiswa_id', $studentId)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('frontend.portal-mahasiswa.perlombaan.index', compact('perlombaan'));
    }

    public function create()
    {
        return view('frontend.portal-mahasiswa.perlombaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perlombaan' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255',
            'juara' => 'required|string|max:100',
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

        Perlombaan::create([
            'mahasiswa_id' => $studentId,
            'nama_perlombaan' => $request->nama_perlombaan,
            'tingkat' => $request->tingkat,
            'penyelenggara' => $request->penyelenggara,
            'juara' => $request->juara,
            'tanggal' => $request->tanggal,
            'file_sertifikat' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Perlombaan Anda berhasil ditambahkan!');
        return redirect()->route('portal-mahasiswa.perlombaan.index');
    }

    public function show($id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $perlombaan = Perlombaan::where('mahasiswa_id', $studentId)->findOrFail($id);
        return view('frontend.portal-mahasiswa.perlombaan.show', compact('perlombaan'));
    }

    public function edit($id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $perlombaan = Perlombaan::where('mahasiswa_id', $studentId)->findOrFail($id);
        return view('frontend.portal-mahasiswa.perlombaan.edit', compact('perlombaan'));
    }

    public function update(Request $request, $id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $perlombaan = Perlombaan::where('mahasiswa_id', $studentId)->findOrFail($id);

        $request->validate([
            'nama_perlombaan' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255',
            'juara' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'file_sertifikat' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
            'deskripsi' => 'nullable|string',
        ]);

        $fileName = $perlombaan->file_sertifikat;
        if ($request->hasFile('file_sertifikat')) {
            // Delete old file if exists
            if ($perlombaan->file_sertifikat) {
                Storage::delete('public/files/prestasi/' . $perlombaan->file_sertifikat);
            }
            $file = $request->file('file_sertifikat');
            $fileName = time() . "_" . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/files/prestasi', $fileName);
        }

        $perlombaan->update([
            'nama_perlombaan' => $request->nama_perlombaan,
            'tingkat' => $request->tingkat,
            'penyelenggara' => $request->penyelenggara,
            'juara' => $request->juara,
            'tanggal' => $request->tanggal,
            'file_sertifikat' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Perlombaan Anda berhasil diperbarui!');
        return redirect()->route('portal-mahasiswa.perlombaan.index');
    }

    public function destroy($id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $perlombaan = Perlombaan::where('mahasiswa_id', $studentId)->findOrFail($id);

        // Delete associated file
        if ($perlombaan->file_sertifikat) {
            Storage::delete('public/files/prestasi/' . $perlombaan->file_sertifikat);
        }

        $perlombaan->delete();

        Session::flash('success', 'Perlombaan Anda berhasil dihapus!');
        return redirect()->route('portal-mahasiswa.perlombaan.index');
    }
}
