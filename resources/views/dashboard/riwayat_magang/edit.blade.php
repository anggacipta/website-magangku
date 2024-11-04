@extends('dashboard.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Data Riwayat Magang</h5>
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="barangForm" action="{{ route('riwayat-magang.update', $riwayat->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="perusahaan" class="form-label">Nama Perusahaan</label>
                                        <input type="text" name="nama_perusahaan" class="form-control" id="perusahaan"
                                               aria-describedby="emailHelp" value="{{ $riwayat->nama_perusahaan }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="posisi" class="form-label">Posisi Magang</label>
                                        <input type="text" name="posisi" class="form-control" id="posisi"
                                               aria-describedby="emailHelp" value="{{ $riwayat->posisi }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Tanggal Mulai</label>
                                        <input type="text" name="tanggal_mulai" class="form-control" id="date2"
                                               aria-describedby="emailHelp" value="{{ date('m/d/Y', strtotime($riwayat->tanggal_mulai)) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Tanggal Selesai</label>
                                        <input type="text" name="tanggal_selesai" class="form-control" id="date3"
                                               aria-describedby="emailHelp" value="{{ date('m/d/Y', strtotime($riwayat->tanggal_selesai)) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsikan secara singkat tentang pengalaman magang</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3">{{ $riwayat->deskripsi }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
@endsection
