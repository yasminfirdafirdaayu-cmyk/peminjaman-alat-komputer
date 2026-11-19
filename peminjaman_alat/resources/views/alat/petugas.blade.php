<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Alat - Petugas</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 25px;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .container {
            max-width: 1150px;
            margin: auto;
        }

        .header {
            background: #1e40af;
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 22px;
        }

        .header h1 {
            margin: 0 0 8px;
        }

        .header p {
            margin: 0;
            color: #dbeafe;
            line-height: 1.5;
        }

        .back {
            display: inline-block;
            margin-bottom: 18px;
            padding: 10px 15px;
            background: #64748b;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            font-size: 13px;
        }

        .back:hover {
            background: #475569;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }

        .card h2 {
            margin-top: 0;
            color: #1e40af;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #eff6ff;
            color: #1e40af;
            font-size: 14px;
        }

        td {
            font-size: 14px;
        }

        .stok {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-weight: bold;
        }

        .habis {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #fee2e2;
            color: #991b1b;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            color: #64748b;
            padding: 25px;
        }

        .info {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            background: #eff6ff;
            color: #1e40af;
            line-height: 1.6;
            font-size: 13px;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #64748b;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }

            .header {
                padding: 20px;
            }

            .card {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h1>Data Alat Komputer</h1>

        <p>
            Halaman pemantauan data alat dan stok oleh Petugas.
        </p>
    </div>

    <!-- TOMBOL KEMBALI -->
    <a href="{{ route('dashboard.petugas') }}" class="back">
        &larr; Kembali ke Dashboard
    </a>

    <!-- TABEL DATA ALAT -->
    <div class="card">

        <h2>Daftar Stok Alat</h2>

        <div class="table-wrapper">

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th>Kondisi</th>
                        <th>Lokasi</th>
                        <th>Stok</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($alats as $alat)

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $alat->nama_alat }}
                            </td>

                            <td>
                                {{ $alat->kategori->nama_kategori ?? '-' }}
                            </td>

                            <td>
                                {{ $alat->kondisi }}
                            </td>

                            <td>
                                {{ $alat->lokasi ?? '-' }}
                            </td>

                            <td>
                                <strong>{{ $alat->stok }}</strong>
                            </td>

                            <td>
                                @if ($alat->stok > 0)

                                    <span class="stok">
                                        Tersedia
                                    </span>

                                @else

                                    <span class="habis">
                                        Stok Habis
                                    </span>

                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="empty">
                                Belum ada data alat.
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>

        </div>

        <div class="info">
            <strong>Informasi Stok:</strong><br>
            Stok tersedia menunjukkan jumlah alat yang dapat dipinjam.
            Stok akan berubah mengikuti proses peminjaman dan pengembalian
            sesuai pengaturan transaksi pada sistem.
        </div>

    </div>

    <div class="footer">
        &copy; Yasmin Firda - Sistem Peminjaman Alat Komputer
    </div>

</div>

</body>
</html>