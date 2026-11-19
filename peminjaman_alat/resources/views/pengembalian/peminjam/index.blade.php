<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengembalian Alat</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
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
            flex-wrap: wrap;
            gap: 12px;
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            background: #2563eb;
            padding: 10px 15px;
            border-radius: 6px;
        }

        .navbar a:hover {
            background: #1d4ed8;
        }

        .container {
            max-width: 1150px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }

        h2, h3 {
            margin-top: 0;
        }

        .fine-info {
            background: #fff7ed;
            border-left: 5px solid #f97316;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            line-height: 1.7;
        }

        .fine-info h3 {
            color: #c2410c;
            margin-bottom: 12px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
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

        input, textarea, select {
            width: 100%;
            padding: 11px;
            margin-top: 7px;
            margin-bottom: 15px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-family: Arial, sans-serif;
        }

        textarea {
            min-height: 85px;
            resize: vertical;
        }

        label {
            font-weight: bold;
        }

        button {
            background: #1d4ed8;
            color: white;
            border: none;
            padding: 11px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #1e40af;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 7px;
            margin-bottom: 20px;
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
            color: #64748b;
            padding: 15px 0;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 5px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: bold;
        }

        .fine {
            color: #c2410c;
            font-weight: bold;
        }

        .form-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 18px;
            margin-top: 18px;
        }

        .footer {
            text-align: center;
            color: #64748b;
            padding: 25px;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 16px;
            }

            .container {
                padding: 0 12px;
                margin-top: 20px;
            }

            .card {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <h2>Pengembalian Alat</h2>

        <a href="{{ route('dashboard.peminjam') }}">
            Kembali ke Dashboard
        </a>
    </div>

    <div class="container">

        <!-- NOTIFIKASI -->
        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert error">
                <strong>Terjadi kesalahan:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- INFORMASI DENDA -->
        <div class="fine-info">
            <h3>⚠️ Informasi Denda Keterlambatan</h3>

            <p>
                Pengembalian alat yang melewati tanggal jatuh tempo
                akan dikenakan denda sebesar
                <strong>Rp10.000 per hari</strong>.
            </p>

            <p>
                Contoh: Meminjam 2 unit alat dan terlambat 3 hari,
                maka total denda adalah
                <strong>Rp30.000</strong>.
            </p>

            <p>
                Denda dihitung secara otomatis oleh sistem
                ketika peminjam mengajukan pengembalian.
                Jumlah unit alat tidak memengaruhi besarnya denda.
            </p>
        </div>

        <!-- DAFTAR ALAT YANG BELUM DIKEMBALIKAN -->
        <div class="card">

            <h2>Daftar Alat yang Harus Dikembalikan</h2>

            <p>
                Isi formulir pengembalian untuk setiap transaksi
                peminjaman yang telah disetujui.
            </p>

            @php
                $peminjamanAktif = $peminjamans->where('status', 'disetujui');
            @endphp

            @forelse($peminjamanAktif as $peminjaman)

                <div class="form-card">

                    <h3>
                        {{ $peminjaman->alat->nama_alat ?? 'Alat tidak ditemukan' }}
                    </h3>

                    <p>
                        <strong>Jumlah dipinjam:</strong>
                        {{ $peminjaman->jumlah }} unit
                    </p>

                    <p>
                        <strong>Tanggal pinjam:</strong>
                        {{ $peminjaman->tanggal_pinjam?->format('d-m-Y') ?? '-' }}
                    </p>

                    <p>
                        <strong>Batas pengembalian:</strong>
                        {{ $peminjaman->tanggal_kembali?->format('d-m-Y') ?? '-' }}
                    </p>

                    <form
                        action="{{ route('pengembalian.peminjam.ajukan', $peminjaman->id) }}"
                        method="POST"
                        onsubmit="return confirm('Apakah kamu yakin ingin mengajukan pengembalian alat ini?')"
                    >

                        @csrf

                        <label>Catatan Transaksi Pengembalian</label>

                        <textarea
                            name="catatan_transaksi"
                            placeholder="Tuliskan catatan pengembalian alat..."
                            required
                            maxlength="1000"
                        >{{ old('catatan_transaksi') }}</textarea>

                        <label>Kondisi Alat Saat Dikembalikan</label>

                        <select name="kondisi_pengembalian" required>
                            <option value="">-- Pilih Kondisi Alat --</option>

                            <option value="baik"
                                {{ old('kondisi_pengembalian') == 'baik' ? 'selected' : '' }}>
                                Baik
                            </option>

                            <option value="rusak_ringan"
                                {{ old('kondisi_pengembalian') == 'rusak_ringan' ? 'selected' : '' }}>
                                Rusak Ringan
                            </option>

                            <option value="rusak_berat"
                                {{ old('kondisi_pengembalian') == 'rusak_berat' ? 'selected' : '' }}>
                                Rusak Berat
                            </option>
                        </select>

                        <button type="submit">
                            Ajukan Pengembalian
                        </button>

                    </form>

                </div>

            @empty

                <p class="empty">
                    Tidak ada alat yang perlu dikembalikan saat ini.
                </p>

            @endforelse

        </div>

        <!-- RIWAYAT PENGEMBALIAN -->
        <div class="card">

            <h2>Riwayat Pengembalian Saya</h2>

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alat</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Kondisi</th>
                            <th>Denda</th>
                            <th>Catatan Transaksi</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @php
                            $riwayat = $peminjamans->where('status', 'dikembalikan');
                        @endphp

                        @forelse($riwayat as $item)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $item->alat->nama_alat ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->jumlah }} unit
                                </td>

                                <td>
                                    {{ $item->tanggal_dikembalikan?->format('d-m-Y') ?? '-' }}
                                </td>

                                <td>
                                    {{ ucwords(str_replace('_', ' ', $item->kondisi_pengembalian ?? '-')) }}
                                </td>

                                <td class="fine">
                                    Rp{{ number_format($item->denda ?? 0, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $item->catatan_transaksi ?? '-' }}
                                </td>

                                <td>
                                    <span class="badge">
                                        Dikembalikan
                                    </span>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="empty">
                                    Belum ada riwayat pengembalian alat.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="footer">
        Sistem Informasi Peminjaman Alat
    </div>

</body>
</html>
