<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Peminjaman</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 30px;
            color: #1e293b;
        }

        .nota {
            max-width: 750px;
            margin: auto;
            padding: 35px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #1e293b;
            padding-bottom: 18px;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0 0 8px;
            font-size: 25px;
        }

        .header p {
            margin: 0;
            color: #64748b;
        }

        h3 {
            margin-top: 25px;
            margin-bottom: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 11px 8px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }

        td:first-child {
            width: 40%;
            font-weight: bold;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
            color: #dc2626;
        }

        .footer {
            text-align: center;
            margin-top: 35px;
            color: #64748b;
            font-size: 13px;
        }

        .actions {
            max-width: 750px;
            margin: 20px auto;
            display: flex;
            gap: 10px;
        }

        .btn {
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .print {
            background: #2563eb;
            color: white;
        }

        .back {
            background: #64748b;
            color: white;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .nota {
                border: none;
                border-radius: 0;
                max-width: 100%;
            }

            .actions {
                display: none;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .nota {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="nota">

        <div class="header">
            <h1>NOTA PEMINJAMAN ALAT</h1>
            <p>Laporan Transaksi Peminjaman dan Pengembalian</p>
        </div>

        <h3>Informasi Transaksi</h3>

        <table>
            <tr>
                <td>ID Transaksi</td>
                <td>{{ $peminjaman->id }}</td>
            </tr>

            <tr>
                <td>Nama Peminjam</td>
                <td>{{ $peminjaman->user->name ?? '-' }}</td>
            </tr>

            <tr>
                <td>Nama Alat</td>
                <td>{{ $peminjaman->alat->nama_alat ?? $peminjaman->alat->nama ?? '-' }}</td>
            </tr>

            <tr>
                <td>Jumlah Dipinjam</td>
                <td>{{ $peminjaman->jumlah }} unit</td>
            </tr>

            <tr>
                <td>Tanggal Peminjaman</td>
                <td>
                    {{ $peminjaman->tanggal_pinjam
                        ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y')
                        : '-' }}
                </td>
            </tr>

            <tr>
                <td>Tanggal Jatuh Tempo</td>
                <td>
                    {{ $peminjaman->tanggal_kembali
                        ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y')
                        : '-' }}
                </td>
            </tr>

            <tr>
                <td>Tanggal Dikembalikan</td>
                <td>
                    {{ $peminjaman->tanggal_dikembalikan
                        ? \Carbon\Carbon::parse($peminjaman->tanggal_dikembalikan)->format('d-m-Y')
                        : '-' }}
                </td>
            </tr>

            <tr>
                <td>Status</td>
                <td>{{ ucfirst($peminjaman->status) }}</td>
            </tr>
        </table>

        <h3>Informasi Pengembalian</h3>

        <table>
            <tr>
                <td>Kondisi Pengembalian</td>
                <td>{{ $peminjaman->kondisi_pengembalian ?? '-' }}</td>
            </tr>

            <tr>
                <td>Catatan Transaksi</td>
                <td>{{ $peminjaman->catatan_transaksi ?? '-' }}</td>
            </tr>

            <tr>
                <td>Denda</td>
                <td class="total">
                    Rp{{ number_format($peminjaman->denda ?? 0, 0, ',', '.') }}
                </td>
            </tr>
        </table>

        <div class="footer">
            <p>Nota ini dicetak oleh Petugas.</p>
            <p>Terima kasih telah menggunakan layanan peminjaman alat.</p>
        </div>

    </div>

    <div class="actions">
        <button class="btn print" onclick="window.print()">
            Cetak Nota
        </button>

        <a href="{{ route('laporan.petugas.index') }}" class="btn back">
            Kembali ke Laporan
        </a>
    </div>

</body>
</html>