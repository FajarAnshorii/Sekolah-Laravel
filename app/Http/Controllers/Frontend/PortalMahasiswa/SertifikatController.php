<?php

namespace App\Http\Controllers\Frontend\PortalMahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SertifikatController extends Controller
{
    public function index()
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $sertifikat = Sertifikat::where('mahasiswa_id', $studentId)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('frontend.portal-mahasiswa.sertifikat.index', compact('sertifikat'));
    }

    public function create()
    {
        return view('frontend.portal-mahasiswa.sertifikat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sertifikat' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jenis' => 'required|string|max:100',
            'jumlah_jam' => 'required|integer|min:1',
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

        Sertifikat::create([
            'mahasiswa_id' => $studentId,
            'nama_sertifikat' => $request->nama_sertifikat,
            'tingkat' => $request->tingkat,
            'penyelenggara' => $request->penyelenggara,
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'jumlah_jam' => $request->jumlah_jam,
            'file_sertifikat' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Sertifikat Anda berhasil ditambahkan!');
        return redirect()->route('portal-mahasiswa.sertifikat.index');
    }

    public function show($id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $sertifikat = Sertifikat::where('mahasiswa_id', $studentId)->findOrFail($id);
        return view('frontend.portal-mahasiswa.sertifikat.show', compact('sertifikat'));
    }

    public function edit($id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $sertifikat = Sertifikat::where('mahasiswa_id', $studentId)->findOrFail($id);
        return view('frontend.portal-mahasiswa.sertifikat.edit', compact('sertifikat'));
    }

    public function update(Request $request, $id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $sertifikat = Sertifikat::where('mahasiswa_id', $studentId)->findOrFail($id);

        $request->validate([
            'nama_sertifikat' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jenis' => 'required|string|max:100',
            'jumlah_jam' => 'required|integer|min:1',
            'file_sertifikat' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
            'deskripsi' => 'nullable|string',
        ]);

        $fileName = $sertifikat->file_sertifikat;
        if ($request->hasFile('file_sertifikat')) {
            // Delete old file if exists
            if ($sertifikat->file_sertifikat) {
                Storage::delete('public/files/prestasi/' . $sertifikat->file_sertifikat);
            }
            $file = $request->file('file_sertifikat');
            $fileName = time() . "_" . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/files/prestasi', $fileName);
        }

        $sertifikat->update([
            'nama_sertifikat' => $request->nama_sertifikat,
            'tingkat' => $request->tingkat,
            'penyelenggara' => $request->penyelenggara,
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'jumlah_jam' => $request->jumlah_jam,
            'file_sertifikat' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Sertifikat Anda berhasil diperbarui!');
        return redirect()->route('portal-mahasiswa.sertifikat.index');
    }

    public function destroy($id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $sertifikat = Sertifikat::where('mahasiswa_id', $studentId)->findOrFail($id);

        // Delete associated file
        if ($sertifikat->file_sertifikat) {
            Storage::delete('public/files/prestasi/' . $sertifikat->file_sertifikat);
        }

        $sertifikat->delete();

        Session::flash('success', 'Sertifikat Anda berhasil dihapus!');
        return redirect()->route('portal-mahasiswa.sertifikat.index');
    }
}
