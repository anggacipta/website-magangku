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
                        <h4 class="fw-semibold mb-8">Berkas Kerja Praktek</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Berkas</li>
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
            <div class="row">
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-header text-bg-primary">
                            <h4 class="mb-0 text-white card-title">Surat Rekomendasi Kerja Praktek</h4>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Berkas Wajib</h3>
                            <p class="card-text">
                                Surat Rekomendasi Kerja Praktek adalah surat yang dikeluarkan oleh Program Studi yang berisi persetujuan dari Program Studi terkait untuk melaksanakan Kerja Praktek.
                            </p>
                            <a href="{{ $signedUrls['surat_kp.pdf']['download'] }}" class="btn btn-primary">Download PDF</a>
                            <a href="{{ $signedUrls['surat_kp.pdf']['preview'] }}" class="btn btn-primary" target="_blank">Preview PDF</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-header text-bg-primary">
                            <h4 class="mb-0 text-white card-title">Proposal Kerja Praktek</h4>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Berkas Wajib</h3>
                            <p class="card-text">
                                Proposal Kerja Praktek adalah dokumen yang berisi rencana kegiatan Kerja Praktek yang akan dilakukan oleh mahasiswa.
                            </p>
                            <a href="{{ $signedUrls['proposal_kp.pdf']['download'] }}" class="btn btn-primary">Download PDF</a>
                            <a href="{{ $signedUrls['proposal_kp.pdf']['preview'] }}" class="btn btn-primary" target="_blank">Preview PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.layouts.footer')
    </div>
@endsection
