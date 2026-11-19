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

        /* NAVBAR */
        .navbar {
            background: #1e40af;
            color: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        /* LOGO APLIKASI */
        .brand-logo {
            width: 52px;
            height: 52px;
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .brand-logo svg {
            width: 35px;
            height: 35px;
        }

        .brand-text h2 {
            margin: 0;
            font-size: 15px;
            letter-spacing: .5px;
        }

        .brand-text span {
            display: block;
            font-size: 11px;
            color: #bfdbfe;
            margin-top: 5px;
        }

        .logout button {
            background: #dc2626;
            color: white;
            border: none;
            padding: 10px 17px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
        }

        .logout button:hover {
            background: #b91c1c;
        }

        .container {
            max-width: 1150px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* SAMBUTAN */
        .welcome {
            background: white;
            padding: 28px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }

        .welcome h2 {
            color: #1e40af;
            margin-top: 0;
        }

        .welcome p {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* STATISTIK */
        .statistics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 23px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }

        .stat-card h3 {
            color: #64748b;
            font-size: 15px;
            margin-top: 0;
        }

        .number {
            font-size: 30px;
            font-weight: bold;
            color: #1e40af;
        }

        .section-title {
            margin-bottom: 17px;
            color: #1e293b;
        }

        /* MENU */
        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 20px;
        }

        .menu-card {
            display: block;
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-decoration: none;
            color: #1e293b;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
            transition: .2s;
            border: 1px solid #e2e8f0;
        }

        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 15px rgba(0,0,0,.10);
        }

        .menu-card .icon {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .menu-card h3 {
            color: #1e40af;
            margin: 0 0 10px;
        }

        .menu-card p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            color: #64748b;
            padding: 25px;
            font-size: 13px;
        }

        /* RESPONSIVE */
        @media (max-width: 600px) {
            .navbar {
                padding: 16px 20px;
            }

            .container {
                margin-top: 20px;
            }

            .welcome {
                padding: 20px;
            }

            .brand-text h2 {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">

        <!-- LOGO DAN IDENTITAS APLIKASI -->
        <div class="brand">

            <div class="brand-logo">

                <svg viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">

                    <rect x="3" y="4" width="18" height="12"
                        rx="2" stroke="white" stroke-width="1.8"/>

                    <path d="M8 20H16M12 16V20"
                        stroke="white" stroke-width="1.8"
                        stroke-linecap="round"/>

                    <path d="M8 10L10 8L12 10"
                        stroke="#BFDBFE" stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"/>

                    <path d="M10 8V12"
                        stroke="#BFDBFE" stroke-width="1.5"
                        stroke-linecap="round"/>

                    <path d="M16 10L14 12L12 10"
                        stroke="#BFDBFE" stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"/>

                </svg>

            </div>

            <div class="brand-text">
                <h2>PEMINJAMAN ALAT KOMPUTER</h2>
                <span>PEMINJAM </span>
            </div>

        </div>

        <form class="logout" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>

    </div>

    <div class="container">

        <!-- SAMBUTAN -->
        <div class="welcome">

            <h2>
                Halo, {{ auth()->user()->name }} Login!
            </h2>

            <p>
                Selamat datang di Sistem Informasi Peminjaman Alat.
                Silakan gunakan menu yang tersedia untuk melakukan
                peminjaman dan pengembalian alat.
            </p>

        </div>

        <!-- STATISTIK -->
        <div class="statistics">

            <div class="stat-card">
                <h3>Alat Tersedia</h3>

                <div class="number">
                    {{ $alatTersedia }}
                </div>
            </div>

            <div class="stat-card">
                <h3>Total Transaksi Peminjaman Saya</h3>

                <div class="number">
                    {{ $totalPeminjamanSaya }}
                </div>
            </div>

        </div>

        <!-- MENU UTAMA -->
        <h2 class="section-title">Menu Utama</h2>

        <div class="menu">

            <!-- DAFTAR ALAT -->
            <a href="{{ route('pengguna.alat') }}" class="menu-card">

                <div class="icon">📦</div>

                <h3>Daftar Alat</h3>

                <p>
                    Lihat daftar alat, kategori, kondisi,
                    dan stok alat yang tersedia untuk dipinjam.
                </p>

            </a>

            <!-- PEMINJAMAN SAYA -->
            <a href="{{ route('peminjaman.saya') }}" class="menu-card">

                <div class="icon">📋</div>

                <h3>Peminjaman Saya</h3>

                <p>
                    Lihat riwayat peminjaman dan status
                    pengajuan alat yang sudah dilakukan.
                </p>

            </a>

            <!-- PENGEMBALIAN ALAT -->
            <a href="{{ route('pengembalian.peminjam.index') }}" class="menu-card">

                <div class="icon">↩️</div>

                <h3>Pengembalian Alat</h3>

                <p>
                    Ajukan pengembalian alat, isi catatan transaksi,
                    pilih kondisi alat, dan lihat riwayat pengembalian.
                </p>

            </a>

        </div>

    </div>

    <!-- FOOTER -->
    <div class="footer">
        @ Yasmin Firda
    </div>

</body>
</html>
