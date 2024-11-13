@extends('dashboard.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Data Mahasiswa</h5>
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
                        <form id="barangForm" action="{{ route('mahasiswa.update', $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Mahasiswa</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                               aria-describedby="emailHelp" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nrp" class="form-label">NRP Mahasiswa</label>
                                        <input type="number" name="nrp" class="form-control" id="nrp"
                                               aria-describedby="emailHelp" value="{{ $user->nrp }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Mahasiswa</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                               aria-describedby="emailHelp" value="{{ $user->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru(kosongkan jika tidak ingin mengganti)</label>
                                <input type="password" name="password" class="form-control" id="password"
                                       aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                                       aria-describedby="emailHelp">
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
