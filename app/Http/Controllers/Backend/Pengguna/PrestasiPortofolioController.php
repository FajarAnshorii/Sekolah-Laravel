<?php

namespace App\Http\Controllers\Backend\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrestasiPortofolioController extends Controller
{
    public function index()
    {
        $portofolio = Portofolio::with('mahasiswa')->get();
        return view('backend.pengguna.prestasi.portofolio.index', compact('portofolio'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::where('status', 'Aktif')->get();
        return view('backend.pengguna.prestasi.portofolio.create', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'link' => 'nullable|url|max:255',
            'tanggal' => 'required|date',
            'file_portofolio' => 'required|file|max:5120',
            'deskripsi' => 'nullable|string',
        ]);

        $fileName = null;
        if ($request->hasFile('file_portofolio')) {
            $file = $request->file('file_portofolio');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/files/prestasi', $fileName);
        }

        Portofolio::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'link' => $request->link,
            'tanggal' => $request->tanggal,
            'file_portofolio' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Portofolio Berhasil ditambah !');
        return redirect()->route('backend-prestasi-portofolio.index');
    }

    public function edit($id)
    {
        $portofolio = Portofolio::findOrFail($id);
        $mahasiswa = Mahasiswa::where('status', 'Aktif')->get();
        return view('backend.pengguna.prestasi.portofolio.edit', compact('portofolio', 'mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $portofolio = Portofolio::findOrFail($id);

        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'link' => 'nullable|url|max:255',
            'tanggal' => 'required|date',
            'file_portofolio' => 'nullable|file|max:5120',
            'deskripsi' => 'nullable|string',
        ]);

        $fileName = $portofolio->file_portofolio;
        if ($request->hasFile('file_portofolio')) {
            $file = $request->file('file_portofolio');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/files/prestasi', $fileName);
        }

        $portofolio->update([
            'mahasiswa_id' => $request->mahasiswa_id,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'link' => $request->link,
            'tanggal' => $request->tanggal,
            'file_portofolio' => $fileName,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Portofolio Berhasil diubah !');
        return redirect()->route('backend-prestasi-portofolio.index');
    }

    public function destroy($id)
    {
        $portofolio = Portofolio::findOrFail($id);
        $portofolio->delete();

        Session::flash('success', 'Portofolio Berhasil dihapus !');
        return redirect()->route('backend-prestasi-portofolio.index');
    }
}
