@extends('dashboard.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        {{--   Profile atas     --}}
        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <img src="{{ asset('storage/images/mahasiswa_profile/'. $mahasiswa?->photo) }}" alt="modernize-img" class="" width="100%" height="200" style="object-fit: cover;">
                <div class="row align-items-center">
                    <div class="col-lg-4 order-lg-1 order-2">
                        <div class="d-flex align-items-center justify-content-around m-4">
{{--                            <div class="text-center">--}}
{{--                                <i class="ti ti-file-description fs-6 d-block mb-2"></i>--}}
{{--                                <h4 class="mb-0 lh-1">938</h4>--}}
{{--                                <p class="mb-0 ">Posts</p>--}}
{{--                            </div>--}}
{{--                            <div class="text-center">--}}
{{--                                <i class="ti ti-user-circle fs-6 d-block mb-2"></i>--}}
{{--                                <h4 class="mb-0 lh-1">3,586</h4>--}}
{{--                                <p class="mb-0 ">Followers</p>--}}
{{--                            </div>--}}
{{--                            <div class="text-center">--}}
{{--                                <i class="ti ti-user-check fs-6 d-block mb-2"></i>--}}
{{--                                <h4 class="mb-0 lh-1">2,659</h4>--}}
{{--                                <p class="mb-0 ">Following</p>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                        <div class="mt-n5">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <div class="d-flex align-items-center justify-content-center round-110">
                                    <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden round-100">
                                        <img src="{{ asset('storage/images/mahasiswa_profile/'. $mahasiswa?->photo) }}" alt="modernize-img" width="100" height="100">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                                <p class="mb-0">Designer</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 order-last">
                        <ul class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-end my-3 mx-4 pe-xxl-4 gap-3">
                            <li>
                                <a class="d-flex align-items-center justify-content-center btn btn-primary p-2 fs-4 rounded-circle" href="javascript:void(0)">
                                    <i class="ti ti-brand-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-secondary d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle" href="javascript:void(0)">
                                    <i class="ti ti-brand-dribbble"></i>
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-danger d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle" href="javascript:void(0)">
                                    <i class="ti ti-brand-youtube"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('profile.mahasiswa.edit') }}" class="btn btn-primary text-nowrap">Edit Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-primary-subtle rounded-2 rounded-top-0" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link hstack gap-2 rounded-0 py-6 active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">
                            <i class="ti ti-user-circle fs-5"></i>
                            <span class="d-none d-md-block">Riwayat Magang</span>
                        </button>
                    </li>
{{--                    <li class="nav-item" role="presentation">--}}
{{--                        <button class="nav-link hstack gap-2 rounded-0 py-6" id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button" role="tab" aria-controls="pills-followers" aria-selected="false" tabindex="-1">--}}
{{--                            <i class="ti ti-heart fs-5"></i>--}}
{{--                            <span class="d-none d-md-block">Followers</span>--}}
{{--                        </button>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item" role="presentation">--}}
{{--                        <button class="nav-link hstack gap-2 rounded-0 py-6" id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab" aria-controls="pills-friends" aria-selected="false" tabindex="-1">--}}
{{--                            <i class="ti ti-user-circle fs-5"></i>--}}
{{--                            <span class="d-none d-md-block">Friends</span>--}}
{{--                        </button>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item" role="presentation">--}}
{{--                        <button class="nav-link hstack gap-2 rounded-0 py-6" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false" tabindex="-1">--}}
{{--                            <i class="ti ti-photo-plus fs-5"></i>--}}
{{--                            <span class="d-none d-md-block">Gallery</span>--}}
{{--                        </button>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </div>
        {{--   Profile bawah     --}}
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-none border">
                            <div class="card-body">
                                <h4 class="mb-3">Introduction</h4>
                                <p class="card-subtitle">{{ auth()->user()->mahasiswa?->deskripsi }}</p>
                                <div class="vstack gap-3 mt-4">
                                    <div class="hstack gap-6">
                                        <i class="ti ti-briefcase text-dark fs-6"></i>
                                        <h6 class=" mb-0">Sir, P P Institute Of Science</h6>
                                    </div>
                                    <div class="hstack gap-6">
                                        <i class="ti ti-mail text-dark fs-6"></i>
                                        <h6 class=" mb-0">{{ auth()->user()->email }}</h6>
                                    </div>
                                    <div class="hstack gap-6">
                                        <i class="ti ti-device-desktop text-dark fs-6"></i>
                                        <h6 class=" mb-0">www.xyz.com</h6>
                                    </div>
                                    <div class="hstack gap-6">
                                        <i class="ti ti-map-pin text-dark fs-6"></i>
                                        <h6 class=" mb-0">Newyork, USA - 100001</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-none border">
                            <div class="card-body">
                                <h4 class="fw-semibold mb-3">Photos</h4>
                                <div class="row">
                                    <div class="col-4">
                                        <img src="../assets/images/profile/user-1.jpg" alt="modernize-img" class="rounded-1 img-fluid mb-9">
                                    </div>
                                    <div class="col-4">
                                        <img src="../assets/images/profile/user-2.jpg" alt="modernize-img" class="rounded-1 img-fluid mb-9">
                                    </div>
                                    <div class="col-4">
                                        <img src="../assets/images/profile/user-3.jpg" alt="modernize-img" class="rounded-1 img-fluid mb-9">
                                    </div>
                                    <div class="col-4">
                                        <img src="../assets/images/profile/user-4.jpg" alt="modernize-img" class="rounded-1 img-fluid mb-9">
                                    </div>
                                    <div class="col-4">
                                        <img src="../assets/images/profile/user-5.jpg" alt="modernize-img" class="rounded-1 img-fluid mb-9">
                                    </div>
                                    <div class="col-4">
                                        <img src="../assets/images/profile/user-6.jpg" alt="modernize-img" class="rounded-1 img-fluid mb-9">
                                    </div>
                                    <div class="col-4">
                                        <img src="../assets/images/profile/user-7.jpg" alt="modernize-img" class="rounded-1 img-fluid mb-6">
                                    </div>
                                    <div class="col-4">
                                        <img src="../assets/images/profile/user-8.jpg" alt="modernize-img" class="rounded-1 img-fluid mb-6">
                                    </div>
                                    <div class="col-4">
                                        <img src="../assets/images/profile/user-1.jpg" alt="modernize-img" class="rounded-1 img-fluid mb-6">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body border-bottom">
                                @foreach ($riwayatMagang as $riwayat)
                                <div class="d-flex align-items-center gap-6 flex-wrap">
                                    <img src="{{ asset('storage/images/mahasiswa_profile/'. $mahasiswa?->photo) }}" alt="modernize-img" class="rounded-circle" width="40" height="40">
                                    <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                                    <span class="fs-2 hstack gap-2">
                                    <span class="round-10 text-bg-light rounded-circle d-inline-block"></span> 15 min
                                        ago
                                    </span>
                                </div>
                                <p class="text-dark my-3">
                                    Nama Perusahaan: {{ $riwayat->nama_perusahaan }} <br>
                                    Posisi saat magang: {{ $riwayat->posisi }} <br>
                                    Tanggal Mulai: {{ Carbon\Carbon::parse($riwayat->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }} <br>
                                    Tanggal Selesai: {{ Carbon\Carbon::parse($riwayat->tanggal_selesai)->locale('id')->translatedFormat('d F Y') }} <br>
                                    Deskripsi singkat saat magang: {{ $riwayat->deskripsi }}
                                </p>
                                <img src="{{ $riwayat->foto_kegiatan ? Storage::url('images/foto_kegiatan/' . $riwayat->foto_kegiatan) : asset('images/mahasiswa_profile/1731397140.jpg') }}" alt="modernize-img" height="360" class="rounded-4 w-100 object-fit-cover">
                                <div class="d-flex align-items-center my-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <a class="round-32 rounded-circle btn btn-primary p-0 hstack justify-content-center" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Like">
                                            <i class="ti ti-thumb-up"></i>
                                        </a>
                                        <span class="text-dark fw-semibold">67</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 ms-4">
                                        <a class="round-32 rounded-circle btn btn-secondary p-0 hstack justify-content-center" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Comment">
                                            <i class="ti ti-message-2"></i>
                                        </a>
                                        <span class="text-dark fw-semibold">2</span>
                                    </div>
                                    <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Share">
                                        <i class="ti ti-share"></i>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
                <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
                    <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Followers <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">20</span>
                    </h3>
                    <form class="position-relative">
                        <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Followers">
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
                    </form>
                </div>
            </div>
        </div>
        @include('dashboard.layouts.footer')
    </div>
@endsection
