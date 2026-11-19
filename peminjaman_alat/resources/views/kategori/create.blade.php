<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

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
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 28px;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0,0,0,.04);
        }

        .back {
            display: inline-block;
            background: #eaf2ff;
            color: #1765df;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 22px;
        }

        h2 {
            color: #172b4d;
            font-size: 21px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 12px;
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #dbe2ea;
            border-radius: 8px;
            margin-bottom: 18px;
            font-family: inherit;
            font-size: 13px;
        }

        input:focus {
            outline: none;
            border-color: #1765df;
        }

        .btn {
            background: #1765df;
            color: white;
            padding: 11px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
        }

        .btn:hover {
            background: #1252b9;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 12px;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('kategori.index') }}" class="back">
        ← Kembali ke Data Kategori
    </a>

    <h2>Tambah Kategori</h2>
    <p class="subtitle">Tambahkan kategori inventaris alat komputer</p>

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf

        <label>Nama Kategori</label>

        <input
            type="text"
            name="nama_kategori"
            value="{{ old('nama_kategori') }}"
            placeholder="Contoh: Komputer"
            required
        >

        <button type="submit" class="btn">
            Simpan Kategori
        </button>
    </form>

</div>

</body>
</html>
