<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,.08);
        }

        h2 {
            margin-top: 0;
            color: #1d4ed8;
        }

        label {
            display: block;
            margin: 16px 0 7px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 15px;
        }

        button, .back {
            display: inline-block;
            margin-top: 22px;
            padding: 11px 18px;
            border: none;
            border-radius: 7px;
            color: white;
            background: #2563eb;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .back {
            background: #64748b;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .alert {
            padding: 12px;
            margin-bottom: 15px;
            color: #b91c1c;
            background: #fee2e2;
            border-radius: 7px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah User Baru</h2>
    <p>Masukkan data pengguna yang akan ditambahkan.</p>

    @if ($errors->any())
        <div class="alert">
            <strong>Periksa kembali data:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <label for="name">Nama Lengkap</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            placeholder="Masukkan nama lengkap"
            required
        >

        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Masukkan email"
            required
        >

        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="Minimal 8 karakter"
            required
        >

        <label for="role">Role Pengguna</label>
        <select id="role" name="role" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
            <option value="peminjam" {{ old('role') == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
        </select>

        <button type="submit">Simpan User</button>
        <a href="{{ route('user.index') }}" class="back">Kembali</a>
    </form>
</div>

</body>
</html>
