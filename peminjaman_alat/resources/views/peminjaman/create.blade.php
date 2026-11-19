<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Form Peminjaman Alat</title>

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
            padding: 25px;
        }

        .container {
            max-width: 650px;
            margin: auto;
        }

        .header {
            background: #1765df;
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 22px;
        }

        .header h1 {
            font-size: 23px;
            margin-bottom: 9px;
        }

        .header p {
            font-size: 14px;
            line-height: 1.6;
        }

        .back {
            display: inline-block;
            color: white;
            text-decoration: none;
            margin-bottom: 17px;
            font-size: 14px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.04);
        }

        .alat-info {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 16px;
            border-radius: 9px;
            margin-bottom: 22px;
        }

        .alat-info h3 {
            color: #1d4ed8;
            margin-bottom: 9px;
        }

        .alat-info p {
            font-size: 14px;
            margin-top: 6px;
        }

        .form-group {
            margin-bottom: 19px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #1765df;
        }

        .denda-info {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            padding: 16px;
            border-radius: 9px;
            margin-bottom: 22px;
        }

        .denda-info h3 {
            color: #c2410c;
            font-size: 16px;
            margin-bottom: 9px;
        }

        .denda-info p {
            font-size: 14px;
            color: #9a3412;
            line-height: 1.7;
        }

        .btn {
            width: 100%;
            background: #1765df;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .alert {
            padding: 13px;
            border-radius: 8px;
            margin-bottom: 17px;
            font-size: 14px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .field-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }

            .card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <section class="header">
        <a href="{{ route('pengguna.alat') }}" class="back">
            ← Kembali ke Daftar Alat
        </a>

        <h1>Form Pengajuan Peminjaman</h1>

        <p>
            Silakan lengkapi data peminjaman alat komputer
            sebelum mengirim pengajuan.
        </p>
    </section>

    @if(session('error'))
        <div class="alert error">
            {{ session('error') }}
        </div>
    @endif

    <section class="card">

        <div class="alat-info">
            <h3>Informasi Alat</h3>

            <p>
                <strong>Nama Alat:</strong>
                {{ $alat->nama_alat }}
            </p>

            <p>
                <strong>Kategori:</strong>
                {{ $alat->kategori->nama_kategori ?? '-' }}
            </p>

            <p>
                <strong>Stok Tersedia:</strong>
                {{ $alat->stok }}
            </p>

            <p>
                <strong>Kondisi Saat Ini:</strong>
                {{ $alat->kondisi ?? '-' }}
            </p>
        </div>

        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

            <input type="hidden" name="alat_id" value="{{ $alat->id }}">

            <div class="form-group">
                <label>Jumlah Alat yang Dipinjam</label>

                <input
                    type="number"
                    name="jumlah"
                    min="1"
                    max="{{ $alat->stok }}"
                    value="{{ old('jumlah', 1) }}"
                    required
                >

                @error('jumlah')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Tanggal Pengembalian</label>

                <input
                    type="date"
                    name="tanggal_kembali"
                    min="{{ date('Y-m-d') }}"
                    value="{{ old('tanggal_kembali') }}"
                    required
                >

                @error('tanggal_kembali')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- INFORMASI DENDA -->
            <div class="denda-info">
                <h3>⚠️ Informasi Denda Keterlambatan</h3>

                <p>
                    Peminjam wajib mengembalikan alat sesuai tanggal
                    pengembalian yang telah ditentukan.
                </p>

                <p>
                    <strong>Denda: Rp10.000 per hari</strong>
                    apabila terlambat mengembalikan alat.
                </p>

                <p>
                    Contoh: Terlambat 3 hari = Rp30.000.
                </p>

                <p>
                    Denda dihitung berdasarkan jumlah hari setelah
                    tanggal jatuh tempo sampai tanggal pengembalian aktual.
                </p>
            </div>

            <button type="submit" class="btn">
                Kirim Pengajuan Peminjaman
            </button>

        </form>

    </section>

</div>

</body>
</html>