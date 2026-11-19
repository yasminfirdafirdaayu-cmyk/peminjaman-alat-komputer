<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Alat</title>

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

        .back:hover {
            background: #1765df;
            color: white;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
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

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #1765df;
            color: white;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #1252b9;
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

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
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
            background: #eaf2ff;
            color: #1765df;
            font-size: 11px;
            font-weight: 600;
        }

        .actions {
            display: flex;
            gap: 7px;
            align-items: center;
        }

        .edit, .delete {
            padding: 8px 11px;
            border: none;
            border-radius: 6px;
            font-size: 11px;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .edit {
            background: #198754;
        }

        .delete {
            background: #dc3545;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #94a3b8;
        }

        @media(max-width: 600px) {
            body {
                padding: 12px;
            }

            .container {
                padding: 17px;
            }

            .header {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

<div class="container">

    @php
        $role = strtolower(trim(auth()->user()->role ?? ''));

        $dashboardRoute = [
            'admin' => 'dashboard.admin',
            'peminjam' => 'dashboard.peminjam',
            'petugas' => 'dashboard.petugas',
        ][$role] ?? 'login';
    @endphp

    <a href="{{ route($dashboardRoute) }}" class="back">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Dashboard
    </a>

    <div class="header">
        <div>
            <h2>Data Alat</h2>

            <p class="subtitle">
                @if($role === 'admin')
                    Kelola inventaris alat komputer
                @else
                    Lihat daftar inventaris alat komputer
                @endif
            </p>
        </div>

        @if($role === 'admin')
            <a href="{{ route('alat.create') }}" class="btn">
                <i class="fas fa-plus"></i>
                Tambah Alat
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Alat</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Kondisi</th>
                    <th>Lokasi</th>

                    @if(in_array($role, ['admin', 'peminjam']))
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @forelse($alats as $alat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <strong>{{ $alat->nama_alat }}</strong>
                        </td>

                        <td>
                            {{ $alat->kategori->nama_kategori ?? '-' }}
                        </td>

                        <td>{{ $alat->stok }}</td>

                        <td>
                            <span class="badge">
                                {{ $alat->kondisi }}
                            </span>
                        </td>

                        <td>{{ $alat->lokasi ?? '-' }}</td>

                        @if($role === 'admin')
                            <td>
                                <div class="actions">
                                    <a href="{{ route('alat.edit', $alat->id) }}"
                                       class="edit">
                                        <i class="fas fa-pen"></i>
                                        Edit
                                    </a>

                                    <form action="{{ route('alat.destroy', $alat->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus alat ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="delete">
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>

                        @elseif($role === 'peminjam')
                            <td>
                                @if($alat->stok > 0)
                                    <a href="{{ route('peminjaman.create', $alat->id) }}"
                                       class="btn">
                                        <i class="fas fa-hand-holding"></i>
                                        Pinjam
                                    </a>
                                @else
                                    <span class="badge">Stok Habis</span>
                                @endif
                            </td>
                        @endif
                    </tr>

                @empty
                    <tr>
                        <td colspan="{{ in_array($role, ['admin', 'peminjam']) ? 7 : 6 }}"
                            class="empty">
                            <i class="fas fa-box-open"></i>
                            <p>Belum ada data alat.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
