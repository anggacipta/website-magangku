@extends('dashboard.layouts.main')
@section('content')
    @include('dashboard.layouts.navbar')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Upload Surat Perusahaan</h5>
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
                        <form action="{{ route('surat-perusahaan.kp.upload', $surat->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="nomor_surat" class="form-label">Status Penerimaan</label>
                                <select class="form-select" name="status_surat" id="status_surat">
                                    <option value="3">Ditolak</option>
                                    <option value="4">Diterima</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="upload_surat">Upload Surat</label>
                                <input type="file" class="form-control" id="upload_surat" name="upload_surat">
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
