@extends('frontend.portal-mahasiswa.layouts.app')

@section('title', 'Tambah Portofolio')

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
        color: #00cfdd;
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
        border-color: #00cfdd;
        box-shadow: 0 0 0 3px rgba(0, 207, 221, 0.15);
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
        background: linear-gradient(135deg, #00cfdd 0%, #00b5c2 100%);
        border: none;
        color: #ffffff;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.65rem 1.6rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 207, 221, 0.25);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-portal-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0, 207, 221, 0.35);
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
</style>
@endsection

@section('content')

    <div class="portal-form-block">
        <!-- HEADER -->
        <div class="portal-form-header">
            <h3 class="portal-form-title">
                <i class="fas fa-plus-circle"></i>
                <span>Tambah Portofolio Baru</span>
            </h3>
            <a href="{{ route('portal-mahasiswa.portofolio.index') }}" class="btn-portal-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- FORM -->
        <form action="{{ route('portal-mahasiswa.portofolio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- JUDUL -->
                <div class="col-md-6 form-group mb-4">
                    <label for="judul">Judul Portofolio <span class="required">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan judul karya/project..." value="{{ old('judul') }}" required>
                    @error('judul')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- KATEGORI -->
                <div class="col-md-6 form-group mb-4">
                    <label for="kategori">Kategori Karya <span class="required">*</span></label>
                    <input type="text" name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror" placeholder="Contoh: Web App, UI/UX Design, IoT..." value="{{ old('kategori') }}" required>
                    @error('kategori')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- TANGGAL -->
                <div class="col-md-6 form-group mb-4">
                    <label for="tanggal">Tanggal Terbit / Selesai <span class="required">*</span></label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
                    @error('tanggal')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- LINK EXTERNAL -->
                <div class="col-md-6 form-group mb-4">
                    <label for="link">Link Eksternal (Opsional)</label>
                    <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror" placeholder="https://github.com/username/project-name atau https://behance.net/..." value="{{ old('link') }}">
                    <small class="text-muted d-block mt-1"><i class="fas fa-info-circle mr-1"></i> Sertakan tautan project aktif, repository GitHub, atau Google Drive</small>
                    @error('link')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- FILE PORTOFOLIO -->
            <div class="form-group mb-4">
                <label for="file_portofolio">File Pendukung / Laporan Project <span class="required">*</span></label>
                <div class="custom-file">
                    <input type="file" name="file_portofolio" id="file_portofolio" class="custom-file-input @error('file_portofolio') is-invalid @enderror" required>
                    <label class="custom-file-label" for="file_portofolio">Pilih file portofolio...</label>
                </div>
                <small class="text-muted d-block mt-1"><i class="fas fa-info-circle mr-1"></i>Format: <strong>PDF, JPG, JPEG, PNG, ZIP, RAR, DOC, DOCX</strong> (Maksimal 5 MB)</small>
                @error('file_portofolio')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- DESKRIPSI -->
            <div class="form-group mb-4">
                <label for="deskripsi">Deskripsi Singkat Project</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Tuliskan penjelasan mengenai latar belakang project, teknologi yang digunakan, serta peran Anda..." rows="5">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- ACTIONS FOOTER -->
            <div class="form-actions-footer">
                <button type="submit" class="btn-portal-submit">
                    <i class="fas fa-save"></i> Simpan Portofolio
                </button>
                <a href="{{ route('portal-mahasiswa.portofolio.index') }}" class="btn-portal-cancel">
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
        var name = document.getElementById("file_portofolio").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = name
    })
</script>
@endsection
