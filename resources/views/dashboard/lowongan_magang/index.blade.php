@extends('dashboard.layouts.main')
<style>
    /* Tambahkan CSS langsung jika tidak menggunakan file terpisah */
    #deskripsiLowongan ul {
        list-style-type: disc;
        padding-left: 20px;
    }

    #deskripsiLowongan ul li {
        margin-bottom: 5px;
    }
</style>

@section('content')
    <!--  Header Start -->
    @include('dashboard.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div>
            <form method="GET" action="{{ route('lowongan-magang.index') }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_pekerjaan" class="form-label">Nama Pekerjaan</label>
                            <input type="text" name="nama_pekerjaan" class="form-control" id="nama_pekerjaan" value="{{ request('nama_pekerjaan') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <select name="lokasi" class="form-select" id="lokasi">
                                <option value="">Pilih Lokasi</option>
                                @foreach($lokasiList as $lokasi)
                                    <option value="{{ $lokasi->id }}" {{ request('lokasi') == $lokasi->nama_lokasi ? 'selected' : '' }}>
                                        {{ $lokasi->nama_lokasi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>
        <div class="row mt-2">
            <!-- Sidebar Lowongan Magang -->
            <div class="col-md-4 col-lg-5">
                <div class="card rounded-3 card-hover" style="height: 80vh; overflow-y: auto;">
                    <div class="card-body">
                        <h4 class="card-title text-dark">Lowongan Magang</h4>
                        @foreach($lowonganMagangs as $lowongan)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <span class="flex-shrink-0">
                                            <i class="ti ti-briefcase text-warning display-6"></i>
                                        </span>
                                        <div class="ms-4">
                                            <h4 class="card-title text-dark">{{ $lowongan->posisi }}</h4>
                                            <h6 class="card-subtitle mb-0 fs-2 fw-normal">
                                                {{ $lowongan->durasi }}
                                            </h6>
                                            <h6 class="card-subtitle mb-0 mt-1 fs-2 fw-normal">
                                                {{ $lowongan->lokasi->nama_lokasi }}
                                            </h6>
                                            <span class="fs-2 mt-1 ">
                                                <button class="btn btn-link p-0 mt-1" onclick="showDetail({{ $lowongan->id }})">Lihat Detail</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Detail Lowongan Magang -->
            <div class="col-md-8 col-lg-7 d-none d-md-block">
                <div class="card rounded-3 shadow-sm card-hover" style="height: 80vh; overflow-y: auto;">
                    <div class="card-body" id="detail-content">
                        @if($lowonganMagangs->isNotEmpty())
                            <div class="text-center mb-4">
                                <!-- Gambar Perusahaan -->
                                <img id="logoPerusahaan" src="{{ Storage::url('images/mahasiswa_profile/' . $lowonganMagangs->first()->pembuat->mahasiswa->photo) }}" 
                                     alt="Logo Perusahaan" class="img-fluid rounded-circle" 
                                     style="width: 80px; height: 80px; object-fit: cover;">
                                
                                <!-- Posisi dan Nama Perusahaan -->
                                <h5 id="posisiLowongan" class="fw-bold text-primary mt-2">{{ $lowonganMagangs->first()->posisi }}</h5>
                                <p id="namaPerusahaan" class="text-muted mb-0">{{ $lowonganMagangs->first()->perusahaan }}</p>
                            </div>

                            <!-- Bagian Deskripsi Lowongan -->
                            <h4 class="fw-bold text-dark">Deskripsi Lowongan</h4>
                            <div class="mt-2" id="deskripsiLowongan">
                                {!! Purifier::clean($lowonganMagangs->first()->deskripsi) !!}
                            </div>

                            <!-- Tombol Apply -->
                            <a href="#" class="btn btn-primary w-100 mt-4">Apply Now</a>
                        @else
                            <p class="text-muted text-center mt-4">No internship details available.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function showDetail(id) {
            let lowonganMagangs = @json($lowonganMagangs);
            let lowongan = lowonganMagangs.find(l => l.id === id);

            if (lowongan) {
                document.getElementById('logoPerusahaan').src = "/storage/" + lowongan.logo;
                document.getElementById('posisiLowongan').innerText = lowongan.posisi;
                document.getElementById('namaPerusahaan').innerText = lowongan.perusahaan;

                // Pastikan deskripsi menampilkan HTML dengan baik
                document.getElementById('deskripsiLowongan').innerHTML = lowongan.deskripsi;
            }
        }
    </script>
@endsection
