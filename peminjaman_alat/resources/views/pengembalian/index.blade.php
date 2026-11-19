<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengembalian</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            color: #263449;
            padding: 25px;
        }

        .container {
            max-width: 1250px;
            margin: auto;
            background: white;
            padding: 28px;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0,0,0,.04);
        }

        .back {
            display: inline-block;
            background: #eaf2ff;
            color: #1765df;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 22px;
        }

        h2 {
            color: #172b4d;
            font-size: 21px;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 12px;
            margin: 7px 0 25px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1100px;
            border-collapse: collapse;
        }

        th {
            background: #1765df;
            color: white;
            padding: 14px 12px;
            font-size: 12px;
            text-align: left;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #edf0f5;
            font-size: 12px;
        }

        tbody tr:hover {
            background: #f7faff;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .belum {
            background: #fef3c7;
            color: #92400e;
        }

        .selesai {
            background: #dcfce7;
            color: #166534;
        }

        .btn {
            background: #16a34a;
            color: white;
            border: none;
            padding: 9px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn:hover {
            background: #15803d;
        }

        .success, .error {
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #94a3b8;
        }

        .denda {
            font-weight: 700;
            color: #dc2626;
        }

        @media(max-width: 600px) {
            body {
                padding: 12px;
            }

            .container {
                padding: 17px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('dashboard.petugas') }}" class="back">
        &larr; Kembali ke Dashboard
    </a>

    <h2>Data Pengembalian Alat</h2>

    <p class="subtitle">
        Kelola pengembalian alat dan perhitungan denda keterlambatan
    </p>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Alat</th>
                    <th>Jumlah</th>
                    <th>Batas Kembali</th>
                    <th>Tanggal Dikembalikan</th>
                    <th>Denda</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($peminjamans as $peminjaman)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $peminjaman->user->name ?? '-' }}
                        </td>

                        <td>
                            {{ $peminjaman->alat->nama_alat ?? '-' }}
                        </td>

                        <td>
                            {{ $peminjaman->jumlah }}
                        </td>

                        <td>
                            {{ $peminjaman->tanggal_kembali
                                ? $peminjaman->tanggal_kembali->format('d-m-Y')
                                : '-' }}
                        </td>

                        <td>
                            {{ $peminjaman->tanggal_dikembalikan
                                ? $peminjaman->tanggal_dikembalikan->format('d-m-Y')
                                : '-' }}
                        </td>

                        <td class="denda">
                            Rp{{ number_format($peminjaman->denda ?? 0, 0, ',', '.') }}
                        </td>

                        <td>
                            @if($peminjaman->status === 'dikembalikan')
                                <span class="badge selesai">
                                    Dikembalikan
                                </span>
                            @else
                                <span class="badge belum">
                                    Belum Dikembalikan
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($peminjaman->status === 'disetujui')
                                <form
                                    action="{{ route('pengembalian.proses', $peminjaman->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah alat benar-benar sudah diterima kembali? Proses ini akan menambah stok dan menghitung denda.')"
                                >
                                    @csrf

                                    <button type="submit" class="btn">
                                        Proses Pengembalian
                                    </button>
                                </form>
                            @else
                                <span style="color:#16a34a;font-weight:600;">
                                    Selesai
                                </span>
                            @endif
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="9" class="empty">
                            Belum ada data pengembalian.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <p style="margin-top:20px;font-size:12px;color:#64748b;">
        Tarif denda keterlambatan: Rp10.000 per hari.
    </p>

</div>

</body>
</html>
