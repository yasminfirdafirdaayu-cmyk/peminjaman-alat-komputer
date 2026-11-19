<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Peminjaman Alat Komputer</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
        }

        .register-box {
            width: 100%;
            max-width: 440px;
            background: white;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 10px 35px rgba(0,0,0,.06);
        }

        .logo {
            width: 55px;
            height: 55px;
            background: #eaf2ff;
            color: #1765df;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 13px;
            font-size: 24px;
            margin: 0 auto 18px;
        }

        h2 {
            text-align: center;
            color: #172b4d;
            font-size: 22px;
            margin-bottom: 9px;
        }

        .subtitle {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            color: #334155;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .input-box {
            position: relative;
        }

        .input-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        input {
            width: 100%;
            padding: 13px 14px 13px 40px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-family: inherit;
            font-size: 12px;
            outline: none;
            background: white;
            color: #334155;
            transition: .2s;
        }

        input:focus {
            border-color: #1765df;
            box-shadow: 0 0 0 3px #1765df15;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94a3b8;
        }

        .password-toggle i {
            position: static;
            transform: none;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: #1765df;
            color: white;
            border: none;
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
            transition: .2s;
        }

        .btn-register:hover {
            background: #1252b9;
        }

        .error-box {
            background: #fee2e2;
            color: #991b1b;
            padding: 13px;
            border-radius: 8px;
            font-size: 12px;
            margin-bottom: 18px;
        }

        .error-box ul {
            padding-left: 18px;
        }

        .login-link {
            text-align: center;
            margin-top: 22px;
            color: #64748b;
            font-size: 12px;
        }

        .login-link a {
            color: #1765df;
            text-decoration: none;
            font-weight: 700;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 10px;
            margin-top: 25px;
        }

        @media(max-width: 480px) {
            .register-box {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>

<div class="register-box">

    <div class="logo">
        <i class="fas fa-user-plus"></i>
    </div>

    <h2>Buat Akun Baru</h2>

    <p class="subtitle">
        Sistem Informasi Peminjaman Alat Komputer
        <br>
        Silakan lengkapi formulir pendaftaran.
    </p>

    {{-- NOTIFIKASI ERROR --}}
    @if ($errors->any())
        <div class="error-box">
            <strong>
                <i class="fas fa-exclamation-circle"></i>
                Periksa kembali data:
            </strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM REGISTER --}}
    <form action="{{ route('register.process') }}" method="POST">
        @csrf

        {{-- NAMA --}}
        <div class="form-group">
            <label for="name">Nama Lengkap</label>

            <div class="input-box">
                <i class="fas fa-user"></i>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    required
                    autofocus
                >
            </div>
        </div>

        {{-- EMAIL --}}
        <div class="form-group">
            <label for="email">Email</label>

            <div class="input-box">
                <i class="fas fa-envelope"></i>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    required
                >
            </div>
        </div>

        {{-- PASSWORD --}}
        <div class="form-group">
            <label for="password">Password</label>

            <div class="input-box">
                <i class="fas fa-lock"></i>

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Minimal 8 karakter"
                    required
                >

                <span class="password-toggle"
                      onclick="togglePassword('password', 'iconPassword')">
                    <i class="fas fa-eye" id="iconPassword"></i>
                </span>
            </div>
        </div>

        {{-- KONFIRMASI PASSWORD --}}
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>

            <div class="input-box">
                <i class="fas fa-lock"></i>

                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="Ulangi password"
                    required
                >

                <span class="password-toggle"
                      onclick="togglePassword('password_confirmation', 'iconConfirm')">
                    <i class="fas fa-eye" id="iconConfirm"></i>
                </span>
            </div>
        </div>

        {{-- ROLE OTOMATIS PEMINJAM --}}
        <button type="submit" class="btn-register">
            <i class="fas fa-user-plus"></i>
            Daftar Sekarang
        </button>

    </form>

    <div class="login-link">
        Sudah punya akun?
        <a href="{{ route('login') }}">Login di sini</a>
    </div>

    <div class="footer">
        © {{ date('Y') }} Sistem Peminjaman Alat Komputer
    </div>

</div>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

</body>
</html>
