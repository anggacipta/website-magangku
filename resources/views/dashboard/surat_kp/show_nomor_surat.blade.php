@extends('dashboard.layouts.main')
@section('content')
    @include('dashboard.layouts.navbar')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Masukkan Nomor Surat</h5>
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
                        <form action="{{ route('surat_kp.update_surat', $surat->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                <input type="text" name="nomor_surat" class="form-control" id="nomor_surat" value="{{ old('nomor_surat') }}">
                            </div>
                            <input type="hidden" name="status_surat" value="2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
@endsection
