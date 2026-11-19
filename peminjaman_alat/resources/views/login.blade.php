<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Peminjaman Alat</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .login-box {
            background: white;
            padding: 30px;
            width: 350px;
            max-width: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 15px #0002;
        }

        h2 {
            text-align: center;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #334155;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 2px #2563eb20;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 15px;
        }

        button:hover {
            background: #1d4ed8;
        }

        .error {
            color: #dc2626;
            background: #fee2e2;
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .success {
            color: #166534;
            background: #dcfce7;
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #64748b;
        }

        .register-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="login-box">

    <h2>Login Peminjaman Alat</h2>

    <p class="subtitle">
        Sistem Informasi Peminjaman Alat Komputer
    </p>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
        @csrf

        <label>Email</label>
        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Masukkan email"
            autocomplete="email"
            required
        >

        <label>Password</label>
        <input
            type="password"
            name="password"
            placeholder="Masukkan password"
            autocomplete="current-password"
            required
        >

        <button type="submit">
            Login
        </button>

    </form>

    <div class="register-link">
        Belum punya akun?
        <a href="{{ route('register') }}">
            Daftar sekarang
        </a>
    </div>

</div>

</body>
</html>
