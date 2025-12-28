@extends('layouts.start')

@section('content')
    <style>
        /* ==== PAGE SETUP ==== */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }

        /* ==== BACKGROUND LAYERS ==== */
        .background {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 20%, #0ea5e9 0%, transparent 25%),
            radial-gradient(circle at 80% 30%, #7c3aed 0%, transparent 25%),
            radial-gradient(circle at 40% 70%, #ef4444 0%, transparent 25%),
            radial-gradient(circle at 90% 80%, #f59e0b 0%, transparent 25%);
            background-size: 200% 200%;
            animation: floatRGB 16s ease-in-out infinite alternate;
            z-index: -2;
        }

        @keyframes floatRGB {
            0% { background-position: 0% 0%; }
            50% { background-position: 100% 100%; }
            100% { background-position: 0% 0%; }
        }

        /* Soft overlay glow */
        .background::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(0,0,0,0.5), rgba(0,0,0,0.2));
            backdrop-filter: blur(4px);
            z-index: -1;
        }

        /* ==== LOGIN CARD ==== */
        .login-card {
            width: 90%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.25);
            padding: 2.2rem;
            animation: fadeIn 1.2s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h3 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
            color: #fff;
        }

        label {
            font-weight: 500;
            color: #f8fafc;
            font-size: 0.9rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 15px rgba(255,255,255,0.4);
        }

        .btn-primary {
            background: linear-gradient(90deg, #0ea5e9, #7c3aed, #ef4444, #f59e0b);
            background-size: 400% 400%;
            animation: btnRGB 8s ease infinite;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 15px rgba(255,255,255,0.6);
        }

        @keyframes btnRGB {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-card p {
            text-align: center;
            margin-top: 1rem;
        }

        a {
            color: #fff;
            text-decoration: underline;
        }

        a:hover {
            text-decoration: none;
            color: #f3f4f6;
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .login-card {
                padding: 1.6rem;
            }
            h3 {
                font-size: 1.4rem;
            }
        }
    </style>

    <div class="background"></div>

    <div class="login-card">
        <h3>🔐 Login</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input name="email" type="email" class="form-control" required value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input name="password" type="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
        </form>

        <p class="mt-3 mb-0">
            Don’t have an account? <a href="{{ route('register') }}">Register</a>
        </p>
    </div>
@endsection

