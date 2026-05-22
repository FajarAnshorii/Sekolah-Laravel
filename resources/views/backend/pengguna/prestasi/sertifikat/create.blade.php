@extends('layouts.backend.app')

@section('title')
    Tambah Sertifikat Mahasiswa
@endsection

@section('content')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2>Sertifikat Mahasiswa</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Tambah Sertifikat Mahasiswa</h4>
                    </div>
                    <div class="card-body mt-2">
                        <form action="{{ route('backend-prestasi-sertifikat.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="nama_sertifikat">Nama Sertifikat <span class="text-danger">*</span></label>
                                        <input type="text" id="nama_sertifikat" class="form-control @error('nama_sertifikat') is-invalid @enderror" name="nama_sertifikat" value="{{ old('nama_sertifikat') }}" placeholder="Contoh: Cisco Certified Network Associate" required />
                                        @error('nama_sertifikat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="tingkat">Tingkat <span class="text-danger">*</span></label>
                                        <select id="tingkat" class="form-control @error('tingkat') is-invalid @enderror" name="tingkat" required>
                                            <option value="">-- Pilih Tingkat --</option>
                                            <option value="Nasional" {{ old('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                            <option value="Provinsi" {{ old('tingkat') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                            <option value="Kabupaten/Kota" {{ old('tingkat') == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                                            <option value="Universitas" {{ old('tingkat') == 'Universitas' ? 'selected' : '' }}>Universitas</option>
                                        </select>
                                        @error('tingkat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="penyelenggara">Penyelenggara <span class="text-danger">*</span></label>
                                        <input type="text" id="penyelenggara" class="form-control @error('penyelenggara') is-invalid @enderror" name="penyelenggara" value="{{ old('penyelenggara') }}" placeholder="Contoh: NetAcad Cisco" required />
                                        @error('penyelenggara')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="jenis">Jenis <span class="text-danger">*</span></label>
                                        <select id="jenis" class="form-control @error('jenis') is-invalid @enderror" name="jenis" required>
                                            <option value="">-- Pilih Jenis --</option>
                                            <option value="Workshop" {{ old('jenis') == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                                            <option value="Seminar" {{ old('jenis') == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                                            <option value="Pelatihan" {{ old('jenis') == 'Pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                                            <option value="Kursus" {{ old('jenis') == 'Kursus' ? 'selected' : '' }}>Kursus</option>
                                        </select>
                                        @error('jenis')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="jumlah_jam">Jumlah Jam <span class="text-danger">*</span></label>
                                        <input type="number" id="jumlah_jam" class="form-control @error('jumlah_jam') is-invalid @enderror" name="jumlah_jam" value="{{ old('jumlah_jam') }}" placeholder="Contoh: 32" required />
                                        @error('jumlah_jam')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal <span class="text-danger">*</span></label>
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
                                        <label for="file_sertifikat">File Sertifikat <span class="text-danger">*</span></label>
                                        <input type="file" id="file_sertifikat" class="form-control-file @error('file_sertifikat') is-invalid @enderror" name="file_sertifikat" required />
                                        <small class="text-muted">Maksimal 5MB (PDF/JPG/PNG)</small>
                                        @error('file_sertifikat')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3" placeholder="Masukkan deskripsi singkat jika ada">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-primary mr-1">Simpan</button>
                                    <a href="{{ route('backend-prestasi-sertifikat.index') }}" class="btn btn-outline-secondary">Batal</a>
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
