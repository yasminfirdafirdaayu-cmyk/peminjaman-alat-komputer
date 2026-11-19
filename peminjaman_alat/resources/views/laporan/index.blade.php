<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Peminjaman Alat</title>

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
            max-width: 1250px;
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
        }

        .back {
            display: inline-block;
            margin-top: 15px;
            color: white;
            text-decoration: none;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 18px;
            margin-bottom: 22px;
        }

        .stat-card, .panel {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,.05);
        }

        .stat-card h3 {
            color: #64748b;
            font-size: 14px;
            margin: 0 0 12px;
        }

        .stat-card strong {
            font-size: 26px;
            color: #1e40af;
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        label {
            font-size: 13px;
            font-weight: bold;
        }

        input, select {
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
        }

        button, .btn {
            display: inline-block;
            padding: 10px 14px;
            border: none;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-blue {
            background: #2563eb;
        }

        .btn-green {
            background: #16a34a;
        }

        .btn-gray {
            background: #64748b;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1050px;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background: #eff6ff;
            color: #1e40af;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
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

        .dikembalikan {
            background: #dbeafe;
            color: #1e40af;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #64748b;
        }

        .pagination {
            margin-top: 20px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .container {
                max-width: 100%;
            }

            .panel, .stat-card {
                box-shadow: none;
                border: 1px solid #ddd;
            }

            table {
                min-width: 100%;
                font-size: 10px;
            }

            th, td {
                padding: 7px;
            }

            .header {
                background: white;
                color: black;
                border: 1px solid #ddd;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }

            .filters {
                flex-direction: column;
                align-items: stretch;
            }

            .form-group,
            input,
            select {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="container">

    {{-- HEADER --}}
    <div class="header">

        <h1>Laporan Peminjaman dan Pengembalian Alat</h1>

        <p>
            Sistem Informasi Peminjaman Alat
            | {{ ucfirst($role) }}
        </p>

        <div class="no-print">

            @if($role === 'petugas')
                <a href="{{ route('dashboard.petugas') }}" class="back">
                    ← Kembali ke Dashboard Petugas
                </a>
            @elseif($role === 'admin')
                <a href="{{ route('dashboard.admin') }}" class="back">
                    ← Kembali ke Dashboard Admin
                </a>
            @endif

        </div>

    </div>


    {{-- STATISTIK --}}
    <div class="stats">

        <div class="stat-card">
            <h3>Total Transaksi</h3>
            <strong>{{ $totalTransaksi }}</strong>
        </div>

        <div class="stat-card">
            <h3>Total Pengembalian</h3>
            <strong>{{ $totalPengembalian }}</strong>
        </div>

        <div class="stat-card">
            <h3>Total Denda</h3>
            <strong>
                Rp{{ number_format($totalDenda, 0, ',', '.') }}
            </strong>
        </div>

    </div>


    {{-- FILTER LAPORAN --}}
    <div class="panel no-print">

        <h3>Filter Laporan</h3>

        <form action="{{ url()->current() }}" method="GET" class="filters">

            <div class="form-group">
                <label>Status Peminjaman</label>

                <select name="status">

                    <option value="">Semua Status</option>

                    <option value="menunggu"
                        {{ request('status') == 'menunggu' ? 'selected' : '' }}>
                        Menunggu
                    </option>

                    <option value="disetujui"
                        {{ request('status') == 'disetujui' ? 'selected' : '' }}>
                        Disetujui
                    </option>

                    <option value="ditolak"
                        {{ request('status') == 'ditolak' ? 'selected' : '' }}>
                        Ditolak
                    </option>

                    <option value="dikembalikan"
                        {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>
                        Dikembalikan
                    </option>

                </select>
            </div>


            <div class="form-group">
                <label>Tanggal Awal</label>

                <input
                    type="date"
                    name="tanggal_awal"
                    value="{{ request('tanggal_awal') }}"
                >
            </div>


            <div class="form-group">
                <label>Tanggal Akhir</label>

                <input
                    type="date"
                    name="tanggal_akhir"
                    value="{{ request('tanggal_akhir') }}"
                >
            </div>


            <button type="submit" class="btn-blue">
                Terapkan Filter
            </button>

            <a href="{{ url()->current() }}" class="btn btn-gray">
                Reset
            </a>

        </form>

    </div>


    {{-- TABEL LAPORAN --}}
    <div class="panel">

        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">

            <h3>Data Laporan Transaksi</h3>

            {{-- TOMBOL CETAK KHUSUS PETUGAS --}}
            @if($role === 'petugas')

                <button
                    type="button"
                    onclick="window.print()"
                    class="btn-green no-print"
                >
                    Cetak / Simpan PDF
                </button>

            @endif

        </div>


        <div class="table-wrap">

            <table>

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Peminjam</th>
                        <th>Nama Alat</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Pengembalian</th>
                        <th>Tanggal Dikembalikan</th>
                        <th>Status</th>
                        <th>Denda</th>

                        @if($role === 'petugas')
                            <th class="no-print">Aksi</th>
                        @endif
                    </tr>
                </thead>


                <tbody>

                    @forelse($peminjamans as $item)

                        <tr>

                            <td>
                                {{ $peminjamans->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $item->user->name ?? '-' }}
                            </td>

                            <td>
                                {{ $item->alat->nama_alat ?? $item->alat->nama ?? '-' }}
                            </td>

                            <td>
                                {{ $item->jumlah }}
                            </td>

                            <td>
                                {{ $item->tanggal_pinjam
                                    ? \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $item->tanggal_kembali
                                    ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $item->tanggal_dikembalikan
                                    ? \Carbon\Carbon::parse($item->tanggal_dikembalikan)->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td>
                                <span class="status {{ $item->status }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <td>
                                Rp{{ number_format($item->denda ?? 0, 0, ',', '.') }}
                            </td>


                            {{-- CETAK NOTA HANYA PETUGAS --}}
                            @if($role === 'petugas')

                                <td class="no-print">

                                    <a
                                        href="{{ route('laporan.petugas.nota', $item->id) }}"
                                        class="btn btn-green"
                                    >
                                        Cetak Nota
                                    </a>

                                </td>

                            @endif

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="{{ $role === 'petugas' ? 10 : 9 }}"
                                class="empty"
                            >
                                Belum ada data laporan.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        <div class="pagination no-print">

            {{ $peminjamans->withQueryString()->links() }}

        </div>

    </div>

</div>

</body>
</html>
