<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Admin - Fuel Monitoring</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 40%, #3b82f6 100%);
            position: relative;
            overflow-x: hidden;
            overflow-y: auto;
            padding: 24px 0;
        }

        body::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(245,158,11,0.15);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        body::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(245,158,11,0.1);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }

        .login-container {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 48px 40px;
            width: 100%;
            max-width: 420px;
            margin: auto;
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
            position: relative;
            z-index: 1;
        }

        .login-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-logo {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 28px;
            color: #fff;
            box-shadow: 0 8px 20px rgba(30,64,175,0.3);
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .login-header p {
            font-size: 14px;
            color: #6b7280;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px 12px 44px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.2s;
            background: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(30,64,175,0.3);
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(30,64,175,0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #9ca3af;
        }

        .login-footer a {
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 13px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">
                <i class="fas fa-gas-pump"></i>
            </div>
            <h1>Daftar Akun Admin</h1>
            <p>Registrasi akun admin baru</p>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.register.submit') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap *</label>
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="Nama admin" required autofocus>
                </div>
                @error('name')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="admin@example.com" required>
                </div>
                @error('email')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password *</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="Minimal 6 karakter" required>
                </div>
                @error('password')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password *</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                           placeholder="Ulangi password" required>
                </div>
            </div>

            <div class="form-group">
                <label for="phone">Telepon</label>
                <div class="input-wrapper">
                    <i class="fas fa-phone"></i>
                    <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                </div>
                @error('phone')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="employee_id">ID Karyawan</label>
                <div class="input-wrapper">
                    <i class="fas fa-id-card"></i>
                    <input type="text" id="employee_id" name="employee_id" class="form-control @error('employee_id') is-invalid @enderror"
                           value="{{ old('employee_id') }}" placeholder="ADM001">
                </div>
                @error('employee_id')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-user-plus"></i> Daftar
            </button>
        </form>

        <div class="login-footer">
            Sudah punya akun? <a href="{{ route('admin.login') }}">Masuk di sini</a>
        </div>
    </div>
</body>
</html>