<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Alat</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            padding: 30px 15px;
            color: #263449;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 13px;
            box-shadow: 0 4px 20px #00000008;
        }

        .back {
            display: inline-flex;
            gap: 8px;
            align-items: center;
            color: #1765df;
            background: #eaf2ff;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 23px;
        }

        .back:hover { background: #1765df; color: white; }

        h2 { color: #172b4d; font-size: 21px; }

        .subtitle {
            color: #94a3b8;
            font-size: 12px;
            margin: 7px 0 25px;
        }

        .form-group { margin-bottom: 19px; }

        label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #dbe2ea;
            border-radius: 7px;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            background: white;
        }

        input:focus, select:focus {
            border-color: #1765df;
            box-shadow: 0 0 0 3px #1765df15;
        }

        .error {
            color: #dc3545;
            font-size: 11px;
            margin-top: 6px;
        }

        .btn {
            width: 100%;
            background: #1765df;
            color: white;
            padding: 13px;
            border: none;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 7px;
        }

        .btn:hover { background: #1252b9; }
    </style>
</head>
<body>

<div class="container">

    <a href="{{ route('alat.index') }}" class="back">
        <i class="fas fa-arrow-left"></i> Kembali ke Data Alat
    </a>

    <h2>Tambah Alat</h2>
    <p class="subtitle">Masukkan informasi alat baru ke dalam sistem.</p>

    <form action="{{ route('alat.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Alat</label>
            <input type="text" name="nama_alat"
                   value="{{ old('nama_alat') }}"
                   placeholder="Masukkan nama alat" required>
            @error('nama_alat') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $item)
                    <option value="{{ $item->id }}"
                        {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" min="0"
                   value="{{ old('stok') }}"
                   placeholder="Masukkan jumlah stok" required>
            @error('stok') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Kondisi</label>
            <select name="kondisi" required>
                <option value="">-- Pilih Kondisi --</option>
                <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
            </select>
            @error('kondisi') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi"
                   value="{{ old('lokasi') }}"
                   placeholder="Contoh: Laboratorium Komputer">
            @error('lokasi') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn">
            <i class="fas fa-save"></i> Simpan Alat
        </button>
    </form>

</div>

</body>
</html>
