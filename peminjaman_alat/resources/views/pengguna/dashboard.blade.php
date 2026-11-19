<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peminjam</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .navbar {
            background: #1e40af;
            color: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .logout button {
            background: #dc2626;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        .container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .welcome {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px #0000000d;
        }

        .welcome h2 {
            margin-top: 0;
            color: #1e40af;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .menu a {
            display: block;
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-decoration: none;
            color: #1e293b;
            box-shadow: 0 2px 8px #0000000d;
            transition: .2s;
        }

        .menu a:hover {
            transform: translateY(-4px);
            box-shadow: 0 5px 15px #00000018;
        }

        .menu h3 {
            color: #1d4ed8;
            margin-top: 0;
        }

        .menu p {
            color: #64748b;
            line-height: 1.5;
        }

        .footer {
            text-align: center;
            padding: 25px;
            color: #64748b;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>Dashboard Peminjam</h2>

        <form class="logout" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="container">

        <div class="welcome">
            <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>
            <p>Silakan pilih menu untuk mengelola peminjaman dan pengembalian alat.</p>
        </div>

        <div class="menu">

            <a href="{{ route('pengguna.alat') }}">
                <h3>Daftar Alat</h3>
                <p>Lihat daftar alat dan stok yang tersedia untuk dipinjam.</p>
            </a>

            <a href="{{ route('peminjaman.saya') }}">
                <h3>Peminjaman Saya</h3>
                <p>Lihat riwayat dan status pengajuan peminjaman alat.</p>
            </a>

            <a href="{{ route('pengembalian.peminjam.index') }}">
                <h3>Pengembalian Alat</h3>
                <p>Ajukan pengembalian alat, isi kondisi alat, dan catatan transaksi.</p>
            </a>

        </div>

    </div>

    <div class="footer">
        Sistem Informasi Peminjaman Alat
    </div>

</body>
</html>
