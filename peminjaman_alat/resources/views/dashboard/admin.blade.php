<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #1e293b;
            color: white;
            padding: 25px 15px;
            flex-shrink: 0;
        }

        /* LOGO APLIKASI */
        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 35px;
            padding: 5px;
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            background: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .brand-logo svg {
            width: 32px;
            height: 32px;
        }

        .brand-text h2 {
            font-size: 13px;
            line-height: 1.5;
            color: white;
            text-align: left;
        }

        .brand-text span {
            display: block;
            color: #93c5fd;
            font-size: 11px;
            margin-top: 3px;
        }

        .sidebar p {
            font-size: 12px;
            color: #94a3b8;
            margin: 20px 12px 10px;
            text-transform: uppercase;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 15px;
            margin-bottom: 5px;
            border-radius: 7px;
            font-size: 14px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #334155;
            color: white;
        }

        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .logout {
            margin-top: 30px;
        }

        .logout button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 7px;
            background: #dc2626;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }

        .logout button:hover {
            background: #b91c1c;
        }

        /* MAIN CONTENT */
        .main {
            flex: 1;
            padding: 30px;
            min-width: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 26px;
            margin-bottom: 8px;
        }

        .header p {
            color: #64748b;
            font-size: 14px;
        }

        .admin-info {
            background: white;
            padding: 12px 18px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            font-size: 14px;
        }

        /* STATISTIK */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .stat-card h3 {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .stat-card .number {
            font-size: 30px;
            font-weight: bold;
            color: #1e293b;
        }

        /* MENU CARD */
        .section-title {
            font-size: 20px;
            margin-bottom: 18px;
        }

        .menu-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .menu-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            text-decoration: none;
            color: #1e293b;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: 0.2s;
        }

        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .menu-card .icon {
            font-size: 30px;
            margin-bottom: 15px;
        }

        .menu-card h3 {
            margin-bottom: 10px;
            font-size: 17px;
        }

        .menu-card p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        /* RESPONSIVE */
        @media (max-width: 1000px) {
            .stats,
            .menu-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 700px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .brand {
                margin-bottom: 20px;
            }

            .main {
                padding: 20px;
            }

            .stats,
            .menu-cards {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- SIDEBAR -->
    <aside class="sidebar">

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
                <h2>PEMINJAMAN<br>ALAT KOMPUTER</h2>
                <span>Halo, Admin Login</span>
            </div>

        </div>

        <p>Menu Utama</p>

        <a href="{{ route('dashboard.admin') }}" class="active">
            Dashboard
        </a>

        <p>Manajemen Data</p>

        <a href="{{ route('alat.index') }}">
            Data Alat
        </a>

        <a href="{{ route('kategori.index') }}">
            Data Kategori
        </a>

        <a href="{{ route('user.index') }}">
            Data Pengguna
        </a>

        <a href="{{ route('admin.peminjaman.index') }}">
            Data Peminjaman
        </a>

        <p>Laporan dan Aktivitas</p>

        <a href="{{ route('laporan.admin.index') }}">
            Laporan
        </a>

        <a href="{{ route('admin.log-aktivitas.index') }}">
            Log Aktivitas
        </a>

        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- KONTEN DASHBOARD -->
    <main class="main">

        <div class="header">

            <div>
                <h1>Dashboard Admin</h1>
                <p>Selamat datang di Sistem Informasi Peminjaman Alat.</p>
            </div>

            <div class="admin-info">
                Admin: <strong>{{ auth()->user()->name }}</strong>
            </div>

        </div>

        <!-- STATISTIK -->
        <div class="stats">

            <div class="stat-card">
                <h3>Total Alat</h3>
                <div class="number">
                    {{ $totalAlat }}
                </div>
            </div>

            <div class="stat-card">
                <h3>Total Pengguna</h3>
                <div class="number">
                    {{ $totalUser }}
                </div>
            </div>

            <div class="stat-card">
                <h3>Total Peminjaman</h3>
                <div class="number">
                    {{ $totalPeminjaman }}
                </div>
            </div>

        </div>

        <!-- MENU DASHBOARD -->
        <h2 class="section-title">Menu Pengelolaan</h2>

        <div class="menu-cards">

            <a href="{{ route('alat.index') }}" class="menu-card">
                <div class="icon">🛠️</div>
                <h3>Data Alat</h3>
                <p>Kelola data alat, tambah alat, ubah data, dan hapus alat.</p>
            </a>

            <a href="{{ route('kategori.index') }}" class="menu-card">
                <div class="icon">📁</div>
                <h3>Data Kategori</h3>
                <p>Kelola kategori alat yang tersedia dalam sistem.</p>
            </a>

            <a href="{{ route('user.index') }}" class="menu-card">
                <div class="icon">👥</div>
                <h3>Data Pengguna</h3>
                <p>Kelola akun admin, petugas, dan peminjam.</p>
            </a>

            <a href="{{ route('admin.peminjaman.index') }}" class="menu-card">
                <div class="icon">📋</div>
                <h3>Data Peminjaman</h3>
                <p>Lihat dan pantau seluruh transaksi peminjaman alat.</p>
            </a>

            <a href="{{ route('laporan.admin.index') }}" class="menu-card">
                <div class="icon">📊</div>
                <h3>Laporan</h3>
                <p>Lihat laporan transaksi peminjaman dan pengembalian.</p>
            </a>

            <a href="{{ route('admin.log-aktivitas.index') }}" class="menu-card">
                <div class="icon">📝</div>
                <h3>Log Aktivitas</h3>
                <p>Lihat riwayat aktivitas admin, petugas, dan peminjam.</p>
            </a>

        </div>

    </main>

</div>

</body>
</html>
