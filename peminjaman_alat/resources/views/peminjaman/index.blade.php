<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 28px;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0,0,0,.04);
        }

        .back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #eaf2ff;
            color: #1765df;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 22px;
        }

        .header {
            margin-bottom: 25px;
        }

        h2 {
            color: #172b4d;
            font-size: 21px;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 7px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        th {
            background: #1765df;
            color: white;
            padding: 15px 12px;
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

        .btn {
            border: none;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            color: white;
            margin: 2px;
        }

        .btn-setujui {
            background: #16a34a;
        }

        .btn-tolak {
            background: #dc2626;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #94a3b8;
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
        <i class="fas fa-arrow-left"></i>
        Kembali ke Dashboard
    </a>

    <div class="header">
        <h2>Data Peminjaman</h2>
        <p class="subtitle">Kelola dan pantau data peminjaman alat komputer</p>
    </div>

    @if(session('success'))
        <div class="success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error">
            <i class="fas fa-exclamation-circle"></i>
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
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($peminjamans as $peminjaman)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $peminjaman->user->name ?? '-' }}</td>
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
                            @php
                                $status = strtolower($peminjaman->status ?? 'menunggu');
                            @endphp

                            <span class="badge {{ $status }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td>
                            @if($status === 'menunggu')
                                <form action="{{ route('peminjaman.setujui', $peminjaman->id) }}"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menyetujui peminjaman ini?')">
                                    @csrf
                                    <button type="submit" class="btn btn-setujui">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                </form>

                                <form action="{{ route('peminjaman.tolak', $peminjaman->id) }}"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menolak peminjaman ini?')">
                                    @csrf
                                    <button type="submit" class="btn btn-tolak">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            @else
                                <span style="color:#94a3b8;">Sudah diproses</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty">
                            <i class="fas fa-box-open"></i>
                            <p>Belum ada data peminjaman.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
