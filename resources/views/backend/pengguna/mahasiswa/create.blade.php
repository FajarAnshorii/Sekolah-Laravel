@extends('layouts.backend.app')

@section('title')
    Tambah Mahasiswa
@endsection

@section('content')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2>Mahasiswa</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Tambah Mahasiswa</h4>
                    </div>
                    <div class="card-body mt-2">
                        <form action="{{ route('backend-pengguna-mahasiswa.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Ahmad Fauzi" required />
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="nim">NIM <span class="text-danger">*</span></label>
                                        <input type="text" id="nim" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" placeholder="Contoh: 2022001" required />
                                        @error('nim')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="program_studi">Program Studi <span class="text-danger">*</span></label>
                                        <select id="program_studi" class="form-control @error('program_studi') is-invalid @enderror" name="program_studi" required>
                                            <option value="">-- Pilih Program Studi --</option>
                                            <option value="Teknik Informatika" {{ old('program_studi') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                                            <option value="Sistem Informasi" {{ old('program_studi') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                            <option value="Teknik Komputer" {{ old('program_studi') == 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
                                            <option value="Rekayasa Perangkat Lunak" {{ old('program_studi') == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                                        </select>
                                        @error('program_studi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="kelas">Kelas <span class="text-danger">*</span></label>
                                        <input type="text" id="kelas" class="form-control @error('kelas') is-invalid @enderror" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: TI 2022 A" required />
                                        @error('kelas')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Contoh: ahmad.fauzi@student.ac.id" required />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="no_hp">No. HP</label>
                                        <input type="text" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" />
                                        @error('no_hp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
                                            <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                    <hr>
                                    <h4 class="mb-1 text-primary"><i data-feather="book-open" class="mr-50"></i> Nilai Akademik</h4>
                                </div>

                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="k1">Nilai K1</label>
                                        <input type="number" step="any" id="k1" class="form-control @error('k1') is-invalid @enderror" name="k1" value="{{ old('k1', 0) }}" placeholder="0" min="0" max="100" />
                                        @error('k1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="k2">Nilai K2</label>
                                        <input type="number" step="any" id="k2" class="form-control @error('k2') is-invalid @enderror" name="k2" value="{{ old('k2', 0) }}" placeholder="0" min="0" max="100" />
                                        @error('k2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="k3">Nilai K3</label>
                                        <input type="number" step="any" id="k3" class="form-control @error('k3') is-invalid @enderror" name="k3" value="{{ old('k3', 0) }}" placeholder="0" min="0" max="100" />
                                        @error('k3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="k4">Nilai K4</label>
                                        <input type="number" step="any" id="k4" class="form-control @error('k4') is-invalid @enderror" name="k4" value="{{ old('k4', 0) }}" placeholder="0" min="0" max="100" />
                                        @error('k4')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="mid">Nilai MID <span class="text-danger">*</span></label>
                                        <input type="number" step="any" id="mid" class="form-control @error('mid') is-invalid @enderror" name="mid" value="{{ old('mid', 0) }}" placeholder="0" min="0" max="100" required />
                                        @error('mid')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="uas">Nilai UAS <span class="text-danger">*</span></label>
                                        <input type="number" step="any" id="uas" class="form-control @error('uas') is-invalid @enderror" name="uas" value="{{ old('uas', 0) }}" placeholder="0" min="0" max="100" required />
                                        @error('uas')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="remidi">Nilai REMIDI</label>
                                        <input type="number" step="any" id="remidi" class="form-control @error('remidi') is-invalid @enderror" name="remidi" value="{{ old('remidi', 0) }}" placeholder="0" min="0" max="100" />
                                        @error('remidi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-primary mr-1">Simpan</button>
                                    <a href="{{ route('backend-pengguna-mahasiswa.index') }}" class="btn btn-outline-secondary">Batal</a>
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
