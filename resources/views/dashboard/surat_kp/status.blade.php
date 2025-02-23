@extends('dashboard.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Status Surat KP</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Status Surat KP</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="{{ asset('assets/modernize/images/backgrounds/rocket.png') }}" alt="modernize-img" class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('surat-kp.status-mahasiswa') }}">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="prodi" class="form-label">Prodi</label>
                        <select name="prodi" class="form-control" id="prodi">
                            <option value="">Pilih Prodi</option>
                            @foreach($prodiList as $prodi)
                                <option value="{{ $prodi->nama_prodi }}" {{ request('prodi') == $prodi->nama_prodi ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="angkatan" class="form-label">Angkatan</label>
                        <select name="angkatan" class="form-control" id="angkatan">
                            <option value="">Pilih Angkatan</option>
                            @foreach($angkatanList as $angkatan)
                                <option value="{{ $angkatan->tahun_angkatan }}" {{ request('angkatan') == $angkatan->tahun_angkatan ? 'selected' : '' }}>
                                    {{ $angkatan->tahun_angkatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>Nama Perusahaan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status Surat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suratKPs as $mahasiswaId => $suratKPGroup)
                        <tr>
                            <td>{{ $suratKPGroup->first()->mahasiswas->user->name }}</td>
                            <td>
                                @foreach($suratKPGroup as $suratKP)
                                    {{ $suratKP->nama_perusahaan }}<br><br>
                                @endforeach
                            </td>
                            <td>
                                @foreach($suratKPGroup as $suratKP)
                                    {{ Carbon\Carbon::parse($suratKP->tanggal_mulai)->locale('id')->translatedFormat('d F Y'); }}<br><br>
                                @endforeach
                            </td>
                            <td>
                                @foreach($suratKPGroup as $suratKP)
                                    {{ Carbon\Carbon::parse($suratKP->tanggal_selesai)->locale('id')->translatedFormat('d F Y') }}<br><br>
                                @endforeach
                            </td>
                            <td>
                                @foreach($suratKPGroup as $suratKP)
                                    @if($suratKP->status_surat == 1)
                                        <span class="badge bg-warning">Menunggu Persetujuan</span>
                                    @elseif($suratKP->status_surat == 2)
                                        <span class="badge bg-primary">Telah Disetujui</span>
                                    @elseif($suratKP->status_surat == 3)
                                        <span class="badge bg-danger">Ditolak Perusahaan</span>
                                    @elseif($suratKP->status_surat == 4)
                                        <span class="badge bg-success">Diterima Perusahaan</span>
                                    @else
                                        <span>Tidak Diketahui</span>
                                    @endif
                                    <br><br>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.layouts.footer')
    </div>
@endsection