<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengelolaan Peminjaman Admin</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 25px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .header, .content {
            background: white;
            padding: 23px;
            border-radius: 12px;
            box-shadow: 0 4px 15px #0001;
            margin-bottom: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        h2 {
            color: #1e293b;
            margin: 0 0 7px;
        }

        .subtitle {
            color: #64748b;
            font-size: 13px;
            margin: 0;
        }

        .back {
            color: white;
            background: #64748b;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 13px;
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0;
        }

        input, select {
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 13px;
        }

        input {
            flex: 1;
            min-width: 180px;
        }

        button, .reset {
            padding: 11px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-size: 13px;
        }

        .search-btn {
            background: #2563eb;
            color: white;
        }

        .reset {
            background: #64748b;
            color: white;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        th, td {
            padding: 13px 11px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            font-size: 13px;
        }

        th {
            background: #f8fafc;
            color: #334155;
        }

        .badge {
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            display: inline-block;
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

        .delete-btn {
            background: #dc3545;
            color: white;
        }

        .message {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
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
            color: #64748b;
            padding: 25px;
        }

        .pagination {
            margin-top: 20px;
        }

        @media(max-width: 600px) {
            body {
                padding: 12px;
            }

            .header, .content {
                padding: 16px;
            }

            .filters {
                flex-direction: column;
            }

            .filters input,
            .filters select,
            .filters button,
            .filters a {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div>
            <h2>Pengelolaan Peminjaman</h2>
            <p class="subtitle">
                Admin - Sistem Informasi Peminjaman Alat Komputer
            </p>
        </div>

        <a href="{{ route('dashboard.admin') }}" class="back">
            ← Dashboard Admin
        </a>
    </div>

    <!-- CONTENT -->
    <div class="content">

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

        <!-- PENCARIAN DAN FILTER -->
        <form action="{{ route('admin.peminjaman.index') }}"
              method="GET"
              class="filters">

            <input
                type="text"
                name="cari"
                placeholder="Cari nama peminjam atau nama alat..."
                value="{{ request('cari') }}"
            >

            <select name="status">
                <option value="">Semua Status</option>

                <option value="menunggu"
                    @selected(request('status') == 'menunggu')>
                    Menunggu
                </option>

                <option value="disetujui"
                    @selected(request('status') == 'disetujui')>
                    Disetujui
                </option>

                <option value="ditolak"
                    @selected(request('status') == 'ditolak')>
                    Ditolak
                </option>

                <option value="dikembalikan"
                    @selected(request('status') == 'dikembalikan')>
                    Dikembalikan
                </option>
            </select>

            <button type="submit" class="search-btn">
                Cari Data
            </button>

            <a href="{{ route('admin.peminjaman.index') }}"
               class="reset">
                Reset
            </a>

        </form>

        <!-- TABEL PEMINJAMAN -->
        <div class="table-wrap">

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Nama Alat</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($peminjamans as $index => $peminjaman)

                        <tr>
                            <td>
                                {{ $peminjamans->firstItem() + $index }}
                            </td>

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
                                {{ $peminjaman->tanggal_pinjam
                                    ? $peminjaman->tanggal_pinjam->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $peminjaman->tanggal_kembali
                                    ? $peminjaman->tanggal_kembali->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td>
                                <span class="badge {{ $peminjaman->status }}">
                                    {{ ucfirst($peminjaman->status) }}
                                </span>
                            </td>

                            <td>
                                @if(in_array($peminjaman->status, ['menunggu', 'ditolak']))

                                    <form
                                        action="{{ route('admin.peminjaman.destroy', $peminjaman->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="delete-btn">
                                            Hapus
                                        </button>
                                    </form>

                                @else
                                    <span>-</span>
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="empty">
                                Belum ada data peminjaman.
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>

        </div>

        <!-- PAGINATION -->
        <div class="pagination">
            {{ $peminjamans->links() }}
        </div>

    </div>

</div>

</body>
</html>
