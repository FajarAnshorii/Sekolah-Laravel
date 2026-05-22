@extends('frontend.portal-mahasiswa.layouts.app')

@section('title', 'Edit Sertifikat')

@section('styles')
<style>
    .portal-form-block {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: none;
        padding: 2.2rem;
        margin-bottom: 2rem;
        position: relative;
    }

    .portal-form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        border-bottom: 1px solid #ebe9f1;
        padding-bottom: 1.2rem;
    }

    .portal-form-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .portal-form-title i {
        color: #28c76f;
    }

    .btn-portal-back {
        background-color: #ff9f43;
        border-color: #ff9f43;
        color: #ffffff !important;
        border-radius: 8px;
        padding: 0.5rem 1.2rem;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 10px rgba(255, 159, 67, 0.2);
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-portal-back:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(255, 159, 67, 0.35);
    }

    .form-group label {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.92rem;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .form-group label span.required {
        color: #ea5455;
    }

    .form-control {
        border-radius: 8px;
        padding: 0.7rem 0.9rem;
        font-size: 0.92rem;
        border: 1.5px solid #ebe9f1;
        background-color: #ffffff;
        color: var(--text-dark);
        height: auto;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: #28c76f;
        box-shadow: 0 0 0 3px rgba(40, 199, 111, 0.15);
        outline: none;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-actions-footer {
        display: flex;
        gap: 12px;
        margin-top: 2.2rem;
        border-top: 1px solid #ebe9f1;
        padding-top: 1.5rem;
    }

    .btn-portal-submit {
        background: linear-gradient(135deg, #28c76f 0%, #3fe085 100%);
        border: none;
        color: #ffffff;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.65rem 1.6rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(40, 199, 111, 0.25);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-portal-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(40, 199, 111, 0.35);
    }

    .btn-portal-cancel {
        background-color: #ffb800;
        border: none;
        color: #ffffff !important;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.65rem 1.6rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(255, 184, 0, 0.2);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-portal-cancel:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(255, 184, 0, 0.3);
    }

    .invalid-feedback {
        font-size: 0.8rem;
        color: #ea5455;
        font-weight: 500;
        display: block;
        margin-top: 0.3rem;
    }

    .current-file-box {
        background-color: #f8f9fa;
        border: 1px solid #ebe9f1;
        padding: 0.8rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text-dark);
    }

    .current-file-box i {
        color: var(--text-muted);
        font-size: 1.1rem;
    }
</style>
@endsection

@section('content')

    <div class="portal-form-block">
        <!-- HEADER -->
        <div class="portal-form-header">
            <h3 class="portal-form-title">
                <i class="fas fa-edit"></i>
                <span>Edit Sertifikat</span>
            </h3>
            <a href="{{ route('portal-mahasiswa.sertifikat.index') }}" class="btn-portal-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- FORM -->
        <form action="{{ route('portal-mahasiswa.sertifikat.update', $sertifikat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- NAMA SERTIFIKAT -->
                <div class="col-md-6 form-group mb-4">
                    <label for="nama_sertifikat">Nama Sertifikat / Pelatihan <span class="required">*</span></label>
                    <input type="text" name="nama_sertifikat" id="nama_sertifikat" class="form-control @error('nama_sertifikat') is-invalid @enderror" value="{{ old('nama_sertifikat', $sertifikat->nama_sertifikat) }}" required>
                    @error('nama_sertifikat')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- PENYELENGGARA -->
                <div class="col-md-6 form-group mb-4">
                    <label for="penyelenggara">Penyelenggara <span class="required">*</span></label>
                    <input type="text" name="penyelenggara" id="penyelenggara" class="form-control @error('penyelenggara') is-invalid @enderror" value="{{ old('penyelenggara', $sertifikat->penyelenggara) }}" required>
                    @error('penyelenggara')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- JENIS SERTIFIKAT -->
                <div class="col-md-4 form-group mb-4">
                    <label for="jenis">Jenis Sertifikat <span class="required">*</span></label>
                    <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                        <option value="" disabled>-- Pilih Jenis --</option>
                        <option value="Pelatihan" {{ old('jenis', $sertifikat->jenis) == 'Pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                        <option value="Seminar" {{ old('jenis', $sertifikat->jenis) == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                        <option value="Workshop" {{ old('jenis', $sertifikat->jenis) == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                        <option value="Sertifikasi Profesi" {{ old('jenis', $sertifikat->jenis) == 'Sertifikasi Profesi' ? 'selected' : '' }}>Sertifikasi Profesi</option>
                    </select>
                    @error('jenis')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- DURASI (JAM) -->
                <div class="col-md-4 form-group mb-4">
                    <label for="jumlah_jam">Durasi (Jumlah Jam) <span class="required">*</span></label>
                    <input type="number" name="jumlah_jam" id="jumlah_jam" class="form-control @error('jumlah_jam') is-invalid @enderror" value="{{ old('jumlah_jam', $sertifikat->jumlah_jam) }}" min="1" required>
                    @error('jumlah_jam')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- TINGKAT -->
                <div class="col-md-4 form-group mb-4">
                    <label for="tingkat">Tingkat Sertifikat <span class="required">*</span></label>
                    <select name="tingkat" id="tingkat" class="form-control @error('tingkat') is-invalid @enderror" required>
                        <option value="" disabled>-- Pilih Tingkat --</option>
                        <option value="Universitas" {{ old('tingkat', $sertifikat->tingkat) == 'Universitas' ? 'selected' : '' }}>Universitas</option>
                        <option value="Kabupaten/Kota" {{ old('tingkat', $sertifikat->tingkat) == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                        <option value="Provinsi" {{ old('tingkat', $sertifikat->tingkat) == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                        <option value="Nasional" {{ old('tingkat', $sertifikat->tingkat) == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                    </select>
                    @error('tingkat')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- TANGGAL -->
                <div class="col-md-6 form-group mb-4">
                    <label for="tanggal">Tanggal Diterbitkan <span class="required">*</span></label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $sertifikat->tanggal) }}" required>
                    @error('tanggal')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- FILE SERTIFIKAT -->
                <div class="col-md-6 form-group mb-4">
                    <label for="file_sertifikat">File Sertifikat</label>
                    
                    @if($sertifikat->file_sertifikat)
                        <div class="current-file-box">
                            <i class="far fa-file-alt"></i>
                            <span><strong>File saat ini:</strong> <a href="{{ asset('storage/files/prestasi/' . $sertifikat->file_sertifikat) }}" target="_blank" download style="color: var(--primary); font-weight: 600; text-decoration: underline;">{{ $sertifikat->file_sertifikat }}</a></span>
                        </div>
                    @endif
                    
                    <div class="custom-file">
                        <input type="file" name="file_sertifikat" id="file_sertifikat" class="custom-file-input @error('file_sertifikat') is-invalid @enderror">
                        <label class="custom-file-label" for="file_sertifikat">Pilih file baru untuk mengganti sertifikat...</label>
                    </div>
                    <small class="text-muted d-block mt-1"><i class="fas fa-info-circle mr-1"></i> Kosongkan jika tidak ingin mengubah file. Format: <strong>PDF, JPG, JPEG, PNG</strong> (Maksimal 5 MB)</small>
                    @error('file_sertifikat')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- DESKRIPSI -->
            <div class="form-group mb-4">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi', $sertifikat->deskripsi) }}</textarea>
                @error('deskripsi')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- ACTIONS FOOTER -->
            <div class="form-actions-footer">
                <button type="submit" class="btn-portal-submit">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('portal-mahasiswa.sertifikat.index') }}" class="btn-portal-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
<script>
    // Custom file input behavior
    document.querySelector('.custom-file-input').addEventListener('change', function (e) {
        var name = document.getElementById("file_sertifikat").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = name
    })
</script>
@endsection
