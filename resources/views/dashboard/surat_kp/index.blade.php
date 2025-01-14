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
                        <h4 class="fw-semibold mb-8">Surat KP</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Surat KP</li>
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
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Perusahaan</th>
                    <th>Tanggal Selesai</th>
                    <th>Tanggal Mulai</th>
                    <th>Status Surat</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($surats as $sur)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $sur->nama_perusahaan }}</td>
                        <td>{{ $sur->tanggal_mulai }}</td>
                        <td>{{ $sur->tanggal_selesai }}</td>
                        <td>
                            @if ($sur->status_surat == 1)
                                <span class="badge bg-warning">Menunggu Validasi</span>
                            @elseif ($sur->status_surat == 2)
                                <span class="badge bg-success">Disetujui</span>
                            @endif
                        </td>
                        <td>
                            @if ($sur->status_surat == 2)
                                {{--             Nothing                   --}}
                            @else
                                <a href="{{ route('surat-kp.show_form', $sur->id) }}" class="btn btn-primary">Validasi</a>
                            @endif
                            <a href="{{ route('surat-kp.show_pdf', $sur->id) }}" class="btn btn-secondary" target="_blank">Tampilkan PDF</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.layouts.footer')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: "Kamu dapat mengembalikan data ini nantinya",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
