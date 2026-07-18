<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — LEN BTC Dashboard</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-color);
            position: relative;
            overflow: hidden;
        }
        /* Decorative background blobs */
        body::before {
            content: '';
            position: absolute;
            top: -120px; left: -120px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(227,24,55,0.15) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }
        body::after {
            content: '';
            position: absolute;
            bottom: -100px; right: -100px;
            width: 420px; height: 420px;
            background: radial-gradient(circle, rgba(227,24,55,0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }
        .login-wrapper {
            position: relative;
            z-index: 1;
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 540px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.15);
            margin: 1.5rem;
        }
        /* Left Panel */
        .login-left {
            flex: 1;
            background: linear-gradient(145deg, var(--len-red) 0%, var(--len-red-dark) 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .login-left::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 220px; height: 220px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }
        .login-left::after {
            content: '';
            position: absolute;
            bottom: -40px; left: -40px;
            width: 160px; height: 160px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
        }
        .login-left .logos {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-bottom: 2.5rem;
        }
        .login-left .logos img {
            height: 40px;
            filter: brightness(0) invert(1);
            object-fit: contain;
        }
        .login-left .logos .divider {
            width: 1px;
            height: 36px;
            background: rgba(255,255,255,0.4);
        }
        .login-left h1 {
            font-size: 1.75rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }
        .login-left p {
            font-size: 0.9rem;
            opacity: 0.8;
            text-align: center;
            line-height: 1.6;
            max-width: 260px;
        }
        .login-left .badge-project {
            margin-top: 2rem;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 50px;
            padding: 0.5rem 1.25rem;
            font-size: 0.8rem;
            font-weight: 500;
            backdrop-filter: blur(4px);
        }
        /* Right Panel */
        .login-right {
            flex: 1;
            background: var(--card-bg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 3.5rem;
        }
        .login-right h2 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.35rem;
        }
        .login-right .subtitle {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 2.25rem;
        }
        .login-form .form-group {
            margin-bottom: 1.25rem;
        }
        .login-form label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-main);
            margin-bottom: 0.45rem;
        }
        .login-form .input-wrapper {
            position: relative;
        }
        .login-form .input-wrapper i {
            position: absolute;
            left: 0.95rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1.1rem;
            pointer-events: none;
        }
        .login-form input {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.75rem;
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-md);
            background: var(--bg-color);
            color: var(--text-main);
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }
        .login-form input:focus {
            outline: none;
            border-color: var(--len-red);
            box-shadow: 0 0 0 3px rgba(227,24,55,0.12);
        }
        .login-form .remember-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.75rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }
        .login-form .remember-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            padding: 0;
            accent-color: var(--len-red);
        }
        .login-form .btn-login {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, var(--len-red) 0%, var(--len-red-dark) 100%);
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.1s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .login-form .btn-login:hover {
            opacity: 0.92;
            transform: translateY(-1px);
        }
        .login-form .btn-login:active {
            transform: translateY(0);
        }
        .error-alert {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            color: #DC2626;
            border-radius: var(--radius-md);
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .demo-hint {
            margin-top: 1.75rem;
            padding: 0.9rem 1rem;
            background: var(--len-red-light);
            border-radius: var(--radius-md);
            font-size: 0.8rem;
            color: var(--text-muted);
            border-left: 3px solid var(--len-red);
        }
        .demo-hint strong {
            color: var(--len-red);
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Left Branding Panel -->
        <div class="login-left">
            <div class="logos">
                <img src="/images/danantara.png" alt="Danantara Indonesia">
                <div class="divider"></div>
                <img src="/images/len.png" alt="LEN Defend ID">
            </div>
            <h1>BTC Project Dashboard</h1>
            <p>Sistem Monitoring & Pengelolaan Proyek Refurbishment KRI</p>
            <div class="badge-project">
                <i class="ph ph-shield-check"></i> Trak / 505 / PLN / IX / 2022 / AL
            </div>
        </div>

        <!-- Right Login Form -->
        <div class="login-right">
            <h2>Selamat Datang</h2>
            <p class="subtitle">Masuk ke akun Anda untuk melanjutkan</p>

            @if($errors->any())
                <div class="error-alert">
                    <i class="ph ph-warning-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form class="login-form" action="{{ route('auth.login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <i class="ph ph-envelope"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               required placeholder="superadmin@len.co.id" autocomplete="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="ph ph-lock"></i>
                        <input type="password" id="password" name="password"
                               required placeholder="••••••••" autocomplete="current-password">
                    </div>
                </div>
                <div class="remember-row">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" style="margin-bottom:0; font-weight:400;">Ingat saya</label>
                </div>
                <button type="submit" class="btn-login">
                    <i class="ph ph-sign-in"></i> Masuk
                </button>
            </form>

            <div class="demo-hint">
                <strong>Akun Demo — Semua password: <code style="background:rgba(227,24,55,0.1); padding:0.1rem 0.4rem; border-radius:4px;">LenBTC@2024</code></strong>
                <div style="margin-top: 0.6rem; display: flex; flex-direction: column; gap: 0.4rem;">
                    <div style="display:flex; align-items:center; gap:0.5rem;">
                        <span style="padding:0.1rem 0.5rem; border-radius:50px; font-size:0.7rem; font-weight:700; background:#E3183722; color:#E31837;">Super Admin</span>
                        <span>superadmin@len.co.id</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:0.5rem;">
                        <span style="padding:0.1rem 0.5rem; border-radius:50px; font-size:0.7rem; font-weight:700; background:#2563EB22; color:#2563EB;">Admin</span>
                        <span>admin@len.co.id</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:0.5rem;">
                        <span style="padding:0.1rem 0.5rem; border-radius:50px; font-size:0.7rem; font-weight:700; background:#64748B22; color:#64748B;">Viewer</span>
                        <span>viewer@len.co.id</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
