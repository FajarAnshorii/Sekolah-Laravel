<?php

namespace App\Http\Controllers\Frontend\PortalMahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    public function index()
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $portofolio = Portofolio::where('mahasiswa_id', $studentId)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('frontend.portal-mahasiswa.portofolio.index', compact('portofolio'));
    }

    public function create()
    {
        return view('frontend.portal-mahasiswa.portofolio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'link' => 'nullable|url|max:255',
            'tanggal' => 'required|date',
            'file_portofolio' => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png,zip,rar,doc,docx',
            'deskripsi' => 'nullable|string',
        ]);

        $studentId = Session::get('portal_mahasiswa_id');
        $fileName = null;

        if ($request->hasFile('file_portofolio')) {
            $file = $request->file('file_portofolio');
            $fileName = time() . "_" . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/files/prestasi', $fileName);
        }

        Portofolio::create([
            'mahasiswa_id' => $studentId,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'link' => $request->link,
            'tanggal' => $request->tanggal,
            'file_portofolio' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Portofolio Anda berhasil ditambahkan!');
        return redirect()->route('portal-mahasiswa.portofolio.index');
    }

    public function show($id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $portofolio = Portofolio::where('mahasiswa_id', $studentId)->findOrFail($id);
        return view('frontend.portal-mahasiswa.portofolio.show', compact('portofolio'));
    }

    public function edit($id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $portofolio = Portofolio::where('mahasiswa_id', $studentId)->findOrFail($id);
        return view('frontend.portal-mahasiswa.portofolio.edit', compact('portofolio'));
    }

    public function update(Request $request, $id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $portofolio = Portofolio::where('mahasiswa_id', $studentId)->findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'link' => 'nullable|url|max:255',
            'tanggal' => 'required|date',
            'file_portofolio' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png,zip,rar,doc,docx',
            'deskripsi' => 'nullable|string',
        ]);

        $fileName = $portofolio->file_portofolio;
        if ($request->hasFile('file_portofolio')) {
            // Delete old file if exists
            if ($portofolio->file_portofolio) {
                Storage::delete('public/files/prestasi/' . $portofolio->file_portofolio);
            }
            $file = $request->file('file_portofolio');
            $fileName = time() . "_" . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/files/prestasi', $fileName);
        }

        $portofolio->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'link' => $request->link,
            'tanggal' => $request->tanggal,
            'file_portofolio' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Portofolio Anda berhasil diperbarui!');
        return redirect()->route('portal-mahasiswa.portofolio.index');
    }

    public function destroy($id)
    {
        $studentId = Session::get('portal_mahasiswa_id');
        $portofolio = Portofolio::where('mahasiswa_id', $studentId)->findOrFail($id);

        // Delete associated file
        if ($portofolio->file_portofolio) {
            Storage::delete('public/files/prestasi/' . $portofolio->file_portofolio);
        }

        $portofolio->delete();

        Session::flash('success', 'Portofolio Anda berhasil dihapus!');
        return redirect()->route('portal-mahasiswa.portofolio.index');
    }
}
