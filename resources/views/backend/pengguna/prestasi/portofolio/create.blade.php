@extends('layouts.backend.app')

@section('title')
    Tambah Portofolio Mahasiswa
@endsection

@section('content')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2>Portofolio Mahasiswa</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Tambah Portofolio Mahasiswa</h4>
                    </div>
                    <div class="card-body mt-2">
                        <form action="{{ route('backend-prestasi-portofolio.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="mahasiswa_id">Pilih Mahasiswa <span class="text-danger">*</span></label>
                                        <select id="mahasiswa_id" class="form-control @error('mahasiswa_id') is-invalid @enderror" name="mahasiswa_id" required>
                                            <option value="">-- Pilih Mahasiswa --</option>
                                            @foreach($mahasiswa as $m)
                                                <option value="{{ $m->id }}" {{ old('mahasiswa_id') == $m->id ? 'selected' : '' }}>
                                                    {{ $m->nama }} ({{ $m->nim }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('mahasiswa_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="judul">Judul Portofolio <span class="text-danger">*</span></label>
                                        <input type="text" id="judul" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" placeholder="Contoh: E-Commerce Web App" required />
                                        @error('judul')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="kategori">Kategori <span class="text-danger">*</span></label>
                                        <input type="text" id="kategori" class="form-control @error('kategori') is-invalid @enderror" name="kategori" value="{{ old('kategori') }}" placeholder="Contoh: Web Development, UI/UX Design, IoT" required />
                                        @error('kategori')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="link">Link Portofolio (URL)</label>
                                        <input type="url" id="link" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') }}" placeholder="Contoh: https://github.com/username/project" />
                                        @error('link')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Pembuatan <span class="text-danger">*</span></label>
                                        <input type="date" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}" required />
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="file_portofolio">File Portofolio <span class="text-danger">*</span></label>
                                        <input type="file" id="file_portofolio" class="form-control-file @error('file_portofolio') is-invalid @enderror" name="file_portofolio" required />
                                        <small class="text-muted">Maksimal 5MB (PDF/JPG/PNG/ZIP/RAR)</small>
                                        @error('file_portofolio')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3" placeholder="Masukkan deskripsi singkat mengenai portofolio ini">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-primary mr-1">Simpan</button>
                                    <a href="{{ route('backend-prestasi-portofolio.index') }}" class="btn btn-outline-secondary">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
