<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Saya</title>

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
            max-width: 1100px;
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
            min-width: 750px;
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

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .menunggu {
            background: #fef3c7;
            color: #92400e;
        }

        .disetujui {
            background: #dcfce7;
            color: #166534;
        }

        .ditolak {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #94a3b8;
        }

        .message {
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

    <a href="{{ route('dashboard.peminjam') }}" class="back">
        &larr; Kembali ke Dashboard
    </a>

    <h2>Peminjaman Saya</h2>
    <p class="subtitle">
        Daftar pengajuan dan status peminjaman alat Anda
    </p>

    @if(session('success'))
        <div class="message success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="message error">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Alat</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($peminjamans as $peminjaman)
                    @php
                        $status = strtolower($peminjaman->status ?? 'menunggu');
                    @endphp

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $peminjaman->alat->nama_alat ?? '-' }}</td>
                        <td>{{ $peminjaman->jumlah }}</td>
                        <td>
                            {{ $peminjaman->tanggal_pinjam
                                ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y')
                                : '-' }}
                        </td>
                        <td>
                            {{ $peminjaman->tanggal_kembali
                                ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y')
                                : '-' }}
                        </td>
                        <td>
                            <span class="badge {{ $status }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Anda belum memiliki pengajuan peminjaman.
                            <br><br>
                            Silakan buka daftar alat untuk mengajukan peminjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
