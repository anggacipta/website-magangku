<!-- resources/views/dashboard/permissions/create.blade.php -->
@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
        <h1>Form Input Data Surat KP</h1>
        <form action="{{ route('surat-kp.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
            </div>
            <div class="mb-3">
                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
            </div>
            <div class="mb-3">
                <label for="alamat_perusahaan" class="form-label">Alamat Perusahaan</label>
                <input type="text" class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" required>
            </div>
            <div class="mb-3">
                <label for="mahasiswa" class="form-label">Nama Mahasiswa</label>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nama</th>
                        <th><button type="button" class="btn btn-primary" id="addMahasiswa">Tambah</button></th>
                    </tr>
                    </thead>
                    <tbody id="mahasiswaTable">
                    <tr>
                        <td><input type="text" class="form-control" name="mahasiswa[0][nama]" required></td>
                        <td><button type="button" class="btn btn-danger removeMahasiswa">Hapus</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="status_surat" value="1">
            <button type="submit" class="btn btn-success">Ajukan Surat KP</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let mahasiswaIndex = 1;
            document.getElementById('addMahasiswa').addEventListener('click', function () {
                const table = document.getElementById('mahasiswaTable');
                const row = document.createElement('tr');
                row.innerHTML = `
                <td><input type="text" class="form-control" name="mahasiswa[${mahasiswaIndex}][nama]" required></td>
                <td><button type="button" class="btn btn-danger removeMahasiswa">Hapus</button></td>
            `;
                table.appendChild(row);
                mahasiswaIndex++;
            });

            document.getElementById('mahasiswaTable').addEventListener('click', function (event) {
                if (event.target.classList.contains('removeMahasiswa')) {
                    event.target.closest('tr').remove();
                }
            });
        });
    </script>
@endsection
