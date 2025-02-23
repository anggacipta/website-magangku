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
                        <h4 class="fw-semibold mb-8">Riwayat Magang</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Riwayat Magang</li>
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
            <form method="GET" action="{{ route('riwayat-magang.mahasiswa') }}">
                <div class="row mb-4">
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
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <div class="row">
                @foreach ($riwayats as $riwa)
                <div class="col-lg-4">
                    <div class="card overflow-hidden hover-img">
                        <div class="position-relative">
                            <a href="javascript:void(0)">
                                <img src="{{ $riwa->foto_kegiatan ? Storage::url('images/foto_kegiatan/' . $riwa->foto_kegiatan) : asset('images/mahasiswa_profile/1731397140.jpg') }}" class="card-img-top" alt="modernize-img">
                            </a>
                            <span class="badge text-bg-light text-dark fs-2 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">
                                {{ $riwa->posisi }}
                            </span>
                            @if ($riwa->user->mahasiswa->photo == null)
                            <img src="{{ asset('images/no_image.png') }}" alt="modernize-img" class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Profile Photo">
                            @else
                                <img src="{{ \Illuminate\Support\Facades\Storage::url('public/images/mahasiswa_profile/' . $riwa->user->mahasiswa->photo) }}" alt="modernize-img" class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Profile Photo">
                            @endif
                        </div>
                        <div class="card-body p-4">
                            <span class="badge text-bg-light fs-2 py-1 px-2 lh-sm  mt-3">{{ $riwa->user->name }}</span>
                            <a class="d-block my-4 fs-5 text-dark fw-semibold link-primary" href="javascript:void(0)">{{ $riwa->deskripsi }}</a>
                            <div class="d-flex align-items-center gap-4">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="ti ti-eye text-dark fs-5"></i>9,125
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="ti ti-message-2 text-dark fs-5"></i>3
                                </div>
                                <div class="d-flex align-items-center fs-2 ms-auto">
                                    <i class="ti ti-point text-dark"></i>{{ \Carbon\Carbon::parse($riwa->created_at)->locale('id')->translatedFormat('d F Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @include('dashboard.layouts.footer')
    </div>
@endsection