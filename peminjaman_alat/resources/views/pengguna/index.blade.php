<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pengguna</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            padding: 25px;
            color: #263449;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0,0,0,.04);
        }

        .back {
            display: inline-block;
            padding: 10px 15px;
            background: #eaf2ff;
            color: #1765df;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            margin-bottom: 25px;
        }

        h2 {
            color: #172b4d;
            margin-bottom: 10px;
        }

        p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
        }

        .profile {
            margin-top: 25px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 10px;
        }

        .profile p {
            margin: 10px 0;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('dashboard.peminjam') }}" class="back">
        ← Kembali ke Dashboard
    </a>

    <h2>Halaman Pengguna</h2>
    <p>Informasi akun pengguna aplikasi peminjaman alat komputer.</p>

    <div class="profile">
        <h3>Informasi Akun</h3>

        <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>

        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>

        <p><strong>Role:</strong> {{ auth()->user()->role }}</p>
    </div>

</div>

</body>
</html>