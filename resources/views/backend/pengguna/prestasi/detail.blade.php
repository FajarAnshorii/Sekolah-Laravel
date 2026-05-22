@extends('layouts.backend.app')

@section('title')
    Detail Prestasi - {{ $mahasiswa->nama }}
@endsection

@section('content')
<div class="content-wrapper container-xxl p-0">
    <!-- Back Button -->
    <div class="content-header row">
        <div class="col-12 mb-1">
            <a href="{{ route('backend-prestasi-overview') }}" class="btn btn-secondary btn-sm" style="background-color: #6e7881; border-color: #6e7881;">
                <i data-feather="arrow-left" class="mr-25 align-middle" style="width: 14px; height: 14px;"></i>Kembali
            </a>
        </div>
    </div>

    <div class="content-body">
        <!-- Student Information Card -->
        <div class="card mb-2">
            <div class="card-body">
                <h3 class="mb-50 font-weight-bolder">{{ $mahasiswa->nama }}</h3>
                <p class="text-muted mb-50"># NIM: {{ $mahasiswa->nim }}</p>
                <div class="d-flex flex-wrap align-items-center" style="font-size: 90%; gap: 15px;">
                    <span class="d-flex align-items-center text-muted">
                        <i data-feather="book-open" class="mr-50" style="width: 16px; height: 16px;"></i>{{ $mahasiswa->program_studi }}
                    </span>
                    <span class="d-flex align-items-center text-muted">
                        <i data-feather="users" class="mr-50" style="width: 16px; height: 16px;"></i>{{ $mahasiswa->kelas }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Achievement Tabs Card -->
        <div class="card">
            <div class="card-body">
                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" role="tablist" style="border-bottom: 2px solid #ebe9f1;">
                    <li class="nav-item">
                        <a class="nav-link active d-flex align-items-center font-weight-bold" id="penghargaan-tab" data-toggle="tab" href="#penghargaan" role="tab" aria-controls="penghargaan" aria-selected="true" style="padding: 1rem 1.5rem;">
                            <i data-feather="award" class="mr-50" style="width: 18px; height: 18px;"></i>Penghargaan ({{ $mahasiswa->penghargaans->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center font-weight-bold" id="sertifikat-tab" data-toggle="tab" href="#sertifikat" role="tab" aria-controls="sertifikat" aria-selected="false" style="padding: 1rem 1.5rem;">
                            <i data-feather="file-text" class="mr-50" style="width: 18px; height: 18px;"></i>Sertifikat ({{ $mahasiswa->sertifikats->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center font-weight-bold" id="perlombaan-tab" data-toggle="tab" href="#perlombaan" role="tab" aria-controls="perlombaan" aria-selected="false" style="padding: 1rem 1.5rem;">
                            <i data-feather="flag" class="mr-50" style="width: 18px; height: 18px;"></i>Perlombaan ({{ $mahasiswa->perlombaans->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center font-weight-bold" id="portofolio-tab" data-toggle="tab" href="#portofolio" role="tab" aria-controls="portofolio" aria-selected="false" style="padding: 1rem 1.5rem;">
                            <i data-feather="briefcase" class="mr-50" style="width: 18px; height: 18px;"></i>Portofolio ({{ $mahasiswa->portofolios->count() }})
                        </a>
                    </li>
                </ul>

                <!-- Tab Contents -->
                <div class="tab-content pt-2">
                    <!-- Penghargaan Tab -->
                    <div class="tab-pane active" id="penghargaan" role="tabpanel" aria-labelledby="penghargaan-tab">
                        @if($mahasiswa->penghargaans->count() > 0)
                            <table class="table table-hover table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA PENGHARGAAN</th>
                                        <th>TINGKAT</th>
                                        <th>PENYELENGGARA</th>
                                        <th>TANGGAL</th>
                                        <th>FILE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mahasiswa->penghargaans as $key => $p)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $p->nama_penghargaan }}</td>
                                            <td><span class="badge badge-light-primary">{{ $p->tingkat }}</span></td>
                                            <td>{{ $p->penyelenggara }}</td>
                                            <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ asset('storage/files/prestasi/' . $p->file_sertifikat) }}" class="btn btn-success btn-sm px-1 py-50 font-weight-bold" style="background-color: #28c76f; border-color: #28c76f;" download>
                                                    <i data-feather="download" class="mr-25 align-middle" style="width: 14px; height: 14px;"></i>Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center py-3 text-muted">
                                <i data-feather="inbox" class="mb-50" style="width: 48px; height: 48px; stroke-width: 1;"></i>
                                <p class="mb-0 font-weight-bold">Belum ada data penghargaan</p>
                            </div>
                        @endif
                    </div>

                    <!-- Sertifikat Tab -->
                    <div class="tab-pane" id="sertifikat" role="tabpanel" aria-labelledby="sertifikat-tab">
                        @if($mahasiswa->sertifikats->count() > 0)
                            <table class="table table-hover table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA SERTIFIKAT</th>
                                        <th>TINGKAT</th>
                                        <th>PENYELENGGARA</th>
                                        <th>JENIS</th>
                                        <th>JUMLAH JAM</th>
                                        <th>TANGGAL</th>
                                        <th>FILE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mahasiswa->sertifikats as $key => $s)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $s->nama_sertifikat }}</td>
                                            <td><span class="badge badge-light-success">{{ $s->tingkat }}</span></td>
                                            <td>{{ $s->penyelenggara }}</td>
                                            <td>{{ $s->jenis }}</td>
                                            <td>{{ $s->jumlah_jam }} Jam</td>
                                            <td>{{ \Carbon\Carbon::parse($s->tanggal)->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ asset('storage/files/prestasi/' . $s->file_sertifikat) }}" class="btn btn-success btn-sm px-1 py-50 font-weight-bold" style="background-color: #28c76f; border-color: #28c76f;" download>
                                                    <i data-feather="download" class="mr-25 align-middle" style="width: 14px; height: 14px;"></i>Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center py-3 text-muted">
                                <i data-feather="inbox" class="mb-50" style="width: 48px; height: 48px; stroke-width: 1;"></i>
                                <p class="mb-0 font-weight-bold">Belum ada data sertifikat</p>
                            </div>
                        @endif
                    </div>

                    <!-- Perlombaan Tab -->
                    <div class="tab-pane" id="perlombaan" role="tabpanel" aria-labelledby="perlombaan-tab">
                        @if($mahasiswa->perlombaans->count() > 0)
                            <table class="table table-hover table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA PERLOMBAAN</th>
                                        <th>TINGKAT</th>
                                        <th>PENYELENGGARA</th>
                                        <th>JUARA</th>
                                        <th>TANGGAL</th>
                                        <th>FILE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mahasiswa->perlombaans as $key => $l)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $l->nama_perlombaan }}</td>
                                            <td><span class="badge badge-light-danger">{{ $l->tingkat }}</span></td>
                                            <td>{{ $l->penyelenggara }}</td>
                                            <td><strong>{{ $l->juara }}</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($l->tanggal)->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ asset('storage/files/prestasi/' . $l->file_sertifikat) }}" class="btn btn-success btn-sm px-1 py-50 font-weight-bold" style="background-color: #28c76f; border-color: #28c76f;" download>
                                                    <i data-feather="download" class="mr-25 align-middle" style="width: 14px; height: 14px;"></i>Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center py-3 text-muted">
                                <i data-feather="inbox" class="mb-50" style="width: 48px; height: 48px; stroke-width: 1;"></i>
                                <p class="mb-0 font-weight-bold">Belum ada data perlombaan</p>
                            </div>
                        @endif
                    </div>

                    <!-- Portofolio Tab -->
                    <div class="tab-pane" id="portofolio" role="tabpanel" aria-labelledby="portofolio-tab">
                        @if($mahasiswa->portofolios->count() > 0)
                            <table class="table table-hover table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>JUDUL PORTOFOLIO</th>
                                        <th>KATEGORI</th>
                                        <th>LINK</th>
                                        <th>TANGGAL</th>
                                        <th>FILE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mahasiswa->portofolios as $key => $port)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $port->judul }}</td>
                                            <td><span class="badge badge-light-primary">{{ $port->kategori }}</span></td>
                                            <td>
                                                @if($port->link)
                                                    <a href="{{ $port->link }}" target="_blank" class="text-truncate d-inline-block" style="max-width: 150px;">{{ $port->link }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($port->tanggal)->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ asset('storage/files/prestasi/' . $port->file_portofolio) }}" class="btn btn-success btn-sm px-1 py-50 font-weight-bold" style="background-color: #28c76f; border-color: #28c76f;" download>
                                                    <i data-feather="download" class="mr-25 align-middle" style="width: 14px; height: 14px;"></i>Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center py-3 text-muted">
                                <i data-feather="inbox" class="mb-50" style="width: 48px; height: 48px; stroke-width: 1;"></i>
                                <p class="mb-0 font-weight-bold">Belum ada data portofolio</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
