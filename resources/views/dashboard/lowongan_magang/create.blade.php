@extends('dashboard.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Lowongan Magang</h5>
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
                        <form action="{{ route('lowongan-magang.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="posisi" class="form-label">Posisi Magang yang dibutuhkan</label>
                                        <input type="text" name="posisi" class="form-control" value="{{ old('posisi') }}" id="posisi" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lokasi" class="form-label">Lokasi Penempatan</label>
                                        <select name="lokasi_id" class="form-select" id="lokasi">
                                            <option value="">Pilih Lokasi</option>
                                            @foreach($lokasiList as $lokasi)
                                                <option value="{{ $lokasi->id }}" {{ request('lokasi') == $lokasi->nama_lokasi ? 'selected' : '' }}>
                                                    {{ $lokasi->nama_lokasi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="durasi" class="form-label">Durasi Magang</label>
                                        <input type="text" name="durasi" class="form-control" value="{{ old('durasi') }}" id="durasi" required placeholder="Contoh: 3 bulan">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <textarea id="myeditorinstance" name="deskripsi">Hello, World!</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
        valid_elements: "p,strong,em,ul,ol,li,a[href|target=_blank],img[src|alt|width|height]",
        extended_valid_elements: "a[href|target=_blank],img[src|alt|width|height]",
    });
    </script>
@endsection