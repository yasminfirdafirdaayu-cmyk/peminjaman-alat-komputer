<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas</title>

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
            max-width: 1200px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0 0 7px;
        }

        .header p {
            margin: 0;
            color: #64748b;
        }

        .btn {
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 11px 18px;
            border-radius: 7px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background: #f8fafc;
        }

        .role {
            display: inline-block;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 12px;
        }

        .empty {
            text-align: center;
            color: #64748b;
            padding: 30px;
        }

        .pagination {
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <div>
            <h1>Log Aktivitas</h1>
            <p>Riwayat aktivitas pengguna aplikasi peminjaman alat.</p>
        </div>

        <a href="{{ route('dashboard.admin') }}" class="btn">
            Kembali ke Dashboard
        </a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Role</th>
                    <th>Aktivitas</th>
                    <th>Deskripsi</th>
                    <th>Alamat IP</th>
                    <th>Waktu</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($aktivitas as $item)
                    <tr>
                        <td>{{ $aktivitas->firstItem() + $loop->index }}</td>

                        <td>{{ $item->user->name ?? 'Pengguna dihapus' }}</td>

                        <td>
                            <span class="role">
                                {{ ucfirst($item->user->role ?? '-') }}
                            </span>
                        </td>

                        <td>{{ $item->aktivitas }}</td>

                        <td>{{ $item->deskripsi ?? '-' }}</td>

                        <td>{{ $item->ip_address ?? '-' }}</td>

                        <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty">
                            Belum ada aktivitas yang tercatat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $aktivitas->links() }}
        </div>
    </div>

</div>

</body>
</html>