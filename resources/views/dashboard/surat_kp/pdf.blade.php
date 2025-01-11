<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Rekomendasi KP</title>
    <style>
        /* Atur margin keseluruhan dokumen untuk menyediakan ruang header & footer */
        @page {
            margin: 120px 30px 100px 30px; /* Top, Right, Bottom, Left */
        }

        /* Style untuk body */
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        .header {
            position: fixed;
            top: -100px;
            left: 0;
            right: 0;
            text-align: center;
            line-height: 1.2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header img {
           position: absolute;
            left: 30px;
            width: 80px;
            height: 80px;
        }

        .header p {
            margin: 2px;
        }


        /* Footer */
        .footer {
            position: fixed;
            bottom: -80px; /* Sesuaikan dengan margin bawah */
            left: 0;
            right: 0;
            text-align: center;
        }

        .footer .page-number:after {
            content: "Halaman " counter(page);
        }

        /* Konten Utama */
        .content {
            margin: 0; /* Tidak ada margin tambahan di konten utama */
        }

        /* Tabel */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        /* Tanda Tangan */
        .signature {
            margin-top: 50px;
            text-align: left;
        }

        .signature p {
            margin: 0;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="{{ public_path('assets/logo-images/Logo_PENS.png') }}" alt="Logo">
    <div>
        <p><strong>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</strong></p>
        <p><strong>POLITEKNIK ELEKTRONIKA NEGERI SURABAYA</strong></p>
        <p>Jalan Raya ITS, Sukolilo Surabaya 60111</p>
        <p>Telepon: +62-41-5947280 (hunting), Faksimile: +62-31-5946114</p>
        <hr>
    </div>
</div>

<div class="content">
    <p><strong>Nomor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong> {{ $surat->nomor_surat }}<br>
        <strong>Lampiran&nbsp;&nbsp; :</strong> Proposal <br>
        <strong>Perihal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong> Permohonan Kerja Praktik
    </p>

    <p>Kepada <br>
        Yth. Pimpinan {{ $surat->nama_perusahaan }} <br>
        {{ $surat->alamat_perusahaan }}
    </p>

    <p>Dengan hormat,</p>

    <p style="text-align: justify">
        Guna memenuhi kurikulum Politeknik Elektronika Negeri Surabaya Tahun Ajaran 2024/2025, maka
        bersama surat ini, kami mohon bantuan Bapak/Ibu Pimpinan untuk memberi kesempatan Kerja
        Praktek (KP) kepada mahasiswa kami selama kurang lebih 6 (enam) bulan. Sesuai dengan jadwal
        perkuliahan yang terdapat di kampus kami, maka kegiatan KP ini direncanakan mulai tanggal
        {{ $formatTanggalMulai }} s/d {{ $formatTanggalSelesai }}. Berikut ini adalah nama-nama mahasiswa yang akan melaksanakan Kerja
        Praktek (KP):
    </p>

    <table class="table">
        <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>NRP</th>
            <th>Program Studi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($surat->mahasiswa as $mhs)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mhs['nama'] }}</td>
                <td>3122521090</td>
                <td>D3 Teknik Informatika PSDKU Lamongan</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p>Demikian surat permohonan ini kami ajukan dan atas perkenan Bapak/Ibu kami mengucapkan terima kasih.</p>
</div>

<div class="signature">
    <p>Lamongan, {{ $currentDate }}</p>
    <p>Mengetahui,</p>
    <p>Ketua Program Studi D3 Teknik Informatika PSDKU PENS Lamongan</p>
    <br><br><br>
    <p><strong>Arif Basofi, S.Kom., M.T.</strong></p>
    <p>NIP. 197609212003121002</p>
</div>
</body>
</html>
