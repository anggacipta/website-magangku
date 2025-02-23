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
                        <h4 class="fw-semibold mb-8">Dashboard</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="javascript:void(0)">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Dashboard</li>
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
        <div class="row">
            <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between">
                      <div>
                        <h4 class="mb-0 card-title fs-6">{{ $mahasiswaCount }}</h4>
                        <p class="card-subtitle">Mahasiswa</p>
                      </div>
                      <span class="text-success fw-normal">+1.20%</span>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between">
                      <div>
                        <h4 class="mb-0 card-title fs-6">{{ $pembimbingCount }}</h4>
                        <p class="card-subtitle">Pembimbing Kerja Praktek</p>
                      </div>
                      <span class="text-success fw-normal">+1.20%</span>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between">
                      <div>
                        <h4 class="mb-0 card-title fs-6">{{ $perusahaanCount }}</h4>
                        <p class="card-subtitle">Perusahaan</p>
                      </div>
                      <span class="text-success fw-normal">+1.20%</span>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between">
                      <div>
                        <h4 class="mb-0 card-title fs-6">{{ $riwayatMagangCount }}</h4>
                        <p class="card-subtitle">Riwayat Magang</p>
                      </div>
                      <span class="text-success fw-normal">+1.20%</span>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        @include('dashboard.layouts.footer')
    </div>
@endsection
