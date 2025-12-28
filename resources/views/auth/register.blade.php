@extends('layouts.start')

@section('content')
    <style>
        /* Fullscreen animated gradient background */
        body {
            margin: 0;
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(270deg, #00ffff, #007bff, #6f42c1, #6610f2);
            background-size: 800% 800%;
            animation: gradientShift 12s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating particle effect */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particles span {
            position: absolute;
            display: block;
            width: 15px;
            height: 15px;
            background: rgba(255, 255, 255, 0.3);
            animation: move 10s linear infinite;
            bottom: -150px;
            border-radius: 50%;
        }

        @keyframes move {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; }
        }

        /* Stylish Card */
        .register-card {
            z-index: 2;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.4);
            transition: all 0.3s ease-in-out;
        }

        .register-card:hover {
            transform: scale(1.03);
            box-shadow: 0 0 35px rgba(0, 255, 255, 0.6);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: white;
            border-radius: 10px;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.8);
        }

        label {
            color: #e2e2e2;
        }

        .btn-register {
            background: linear-gradient(90deg, #00ffff, #007bff);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: linear-gradient(90deg, #007bff, #00ffff);
            transform: scale(1.05);
        }

        .register-link a {
            color: #00ffff;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="particles">
        @for($i = 0; $i < 25; $i++)
            <span style="left: {{ rand(0,100) }}%; animation-delay: {{ rand(0,10) }}s; animation-duration: {{ rand(5,15) }}s;"></span>
        @endfor
    </div>

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="register-card p-4 text-white" style="width: 400px;">
            <h3 class="text-center mb-3">✨ Create Your Account</h3>

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ url('/register') }}">
                @csrf
                <div class="mb-3">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" required value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input name="password_confirmation" type="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-register w-100">Register</button>
            </form>

            <p class="text-center mt-3 register-link mb-0">
                Already have an account? <a href="{{ route('login') }}">Login</a>
            </p>
        </div>
    </div>
@endsection
{{--@extends('layouts.start')--}}

{{--@section('content')--}}
{{--    <style>--}}
{{--        /* ==== GLOBAL ==== */--}}
{{--        body {--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--            height: 100vh;--}}
{{--            overflow: hidden;--}}
{{--            display: flex;--}}
{{--            justify-content: center;--}}
{{--            align-items: center;--}}
{{--            font-family: 'Poppins', sans-serif;--}}
{{--            color: #fff;--}}
{{--        }--}}

{{--        /* ==== BACKGROUND AURORA ==== */--}}
{{--        .aurora {--}}
{{--            position: fixed;--}}
{{--            top: 0;--}}
{{--            left: 0;--}}
{{--            width: 100%;--}}
{{--            height: 100%;--}}
{{--            background: radial-gradient(circle at 20% 30%, #00e5ff 0%, transparent 30%),--}}
{{--            radial-gradient(circle at 80% 40%, #00ff95 0%, transparent 30%),--}}
{{--            radial-gradient(circle at 40% 80%, #007cf0 0%, transparent 35%),--}}
{{--            radial-gradient(circle at 70% 90%, #00ffb3 0%, transparent 30%);--}}
{{--            background-size: 200% 200%;--}}
{{--            animation: auroraMove 14s ease-in-out infinite alternate;--}}
{{--            z-index: -2;--}}
{{--        }--}}

{{--        @keyframes auroraMove {--}}
{{--            0% { background-position: 0% 0%; }--}}
{{--            50% { background-position: 100% 100%; }--}}
{{--            100% { background-position: 0% 0%; }--}}
{{--        }--}}

{{--        /* Dark translucent overlay */--}}
{{--        .aurora::after {--}}
{{--            content: "";--}}
{{--            position: absolute;--}}
{{--            inset: 0;--}}
{{--            background: linear-gradient(135deg, rgba(0,0,0,0.5), rgba(0,0,0,0.25));--}}
{{--            backdrop-filter: blur(4px);--}}
{{--            z-index: -1;--}}
{{--        }--}}

{{--        /* ==== CARD ==== */--}}
{{--        .register-card {--}}
{{--            width: 90%;--}}
{{--            max-width: 420px;--}}
{{--            background: rgba(255, 255, 255, 0.1);--}}
{{--            backdrop-filter: blur(20px);--}}
{{--            -webkit-backdrop-filter: blur(20px);--}}
{{--            border-radius: 20px;--}}
{{--            padding: 2.2rem;--}}
{{--            box-shadow: 0 10px 30px rgba(0,0,0,0.25);--}}
{{--            animation: floatCard 3s ease-in-out infinite alternate, fadeIn 1s ease-out;--}}
{{--        }--}}

{{--        @keyframes fadeIn {--}}
{{--            from { opacity: 0; transform: translateY(30px); }--}}
{{--            to { opacity: 1; transform: translateY(0); }--}}
{{--        }--}}

{{--        @keyframes floatCard {--}}
{{--            from { transform: translateY(0px); }--}}
{{--            to { transform: translateY(-10px); }--}}
{{--        }--}}

{{--        /* ==== TEXT ==== */--}}
{{--        h3 {--}}
{{--            text-align: center;--}}
{{--            font-weight: 700;--}}
{{--            margin-bottom: 1.5rem;--}}
{{--            letter-spacing: 1px;--}}
{{--            color: #e0f2fe;--}}
{{--        }--}}

{{--        label {--}}
{{--            font-weight: 500;--}}
{{--            color: #f8fafc;--}}
{{--            font-size: 0.9rem;--}}
{{--        }--}}

{{--        /* ==== INPUTS ==== */--}}
{{--        .form-control {--}}
{{--            background: rgba(255, 255, 255, 0.2);--}}
{{--            border: none;--}}
{{--            color: #fff;--}}
{{--            border-radius: 10px;--}}
{{--            transition: all 0.3s ease;--}}
{{--        }--}}

{{--        .form-control:focus {--}}
{{--            background: rgba(255, 255, 255, 0.3);--}}
{{--            box-shadow: 0 0 15px rgba(0, 255, 180, 0.5);--}}
{{--        }--}}

{{--        /* ==== BUTTON ==== */--}}
{{--        .btn-success {--}}
{{--            background: linear-gradient(90deg, #00e5ff, #00ffb3, #007cf0, #00ff95);--}}
{{--            background-size: 400% 400%;--}}
{{--            animation: buttonFlow 8s ease infinite;--}}
{{--            border: none;--}}
{{--            border-radius: 12px;--}}
{{--            font-weight: 600;--}}
{{--            letter-spacing: 0.5px;--}}
{{--            transition: transform 0.3s ease, box-shadow 0.3s ease;--}}
{{--        }--}}

{{--        @keyframes buttonFlow {--}}
{{--            0% { background-position: 0% 50%; }--}}
{{--            50% { background-position: 100% 50%; }--}}
{{--            100% { background-position: 0% 50%; }--}}
{{--        }--}}

{{--        .btn-success:hover {--}}
{{--            transform: translateY(-3px);--}}
{{--            box-shadow: 0 0 18px rgba(0,255,180,0.7);--}}
{{--        }--}}

{{--        /* ==== FOOTER TEXT ==== */--}}
{{--        p {--}}
{{--            text-align: center;--}}
{{--            margin-top: 1rem;--}}
{{--        }--}}

{{--        a {--}}
{{--            color: #bbf7d0;--}}
{{--            text-decoration: underline;--}}
{{--        }--}}

{{--        a:hover {--}}
{{--            text-decoration: none;--}}
{{--            color: #d1fae5;--}}
{{--        }--}}

{{--        /* Responsive */--}}
{{--        @media (max-width: 480px) {--}}
{{--            .register-card {--}}
{{--                padding: 1.6rem;--}}
{{--            }--}}
{{--            h3 {--}}
{{--                font-size: 1.4rem;--}}
{{--            }--}}
{{--        }--}}
{{--    </style>--}}

{{--    <div class="aurora"></div>--}}

{{--    <div class="register-card">--}}
{{--        <h3>🧾 Register</h3>--}}

{{--        @if($errors->any())--}}
{{--            <div class="alert alert-danger">{{ $errors->first() }}</div>--}}
{{--        @endif--}}

{{--        <form method="POST" action="{{ url('/register') }}">--}}
{{--            @csrf--}}
{{--            <div class="mb-3">--}}
{{--                <label>Name</label>--}}
{{--                <input name="name" type="text" class="form-control" required value="{{ old('name') }}">--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label>Email</label>--}}
{{--                <input name="email" type="email" class="form-control" required value="{{ old('email') }}">--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label>Password</label>--}}
{{--                <input name="password" type="password" class="form-control" required>--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label>Confirm Password</label>--}}
{{--                <input name="password_confirmation" type="password" class="form-control" required>--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-success w-100 py-2">Register</button>--}}
{{--        </form>--}}

{{--        <p class="mt-3 mb-0">Already registered?--}}
{{--            <a href="{{ route('login') }}">Login</a>--}}
{{--        </p>--}}
{{--    </div>--}}
{{--@endsection--}}
{{-------------------------------------------------------------------------------------------------------}}
{{--@extends('layouts.start')--}}

{{--@section('content')--}}
{{--    <div class="d-flex justify-content-center align-items-center vh-100 bg-light">--}}
{{--        <div class="card shadow p-4" style="width: 400px;">--}}
{{--            <h3 class="text-center mb-3">🧾 Register</h3>--}}

{{--            @if($errors->any())--}}
{{--                <div class="alert alert-danger">{{ $errors->first() }}</div>--}}
{{--            @endif--}}

{{--            <form method="POST" action="{{ url('/register') }}">--}}
{{--                @csrf--}}
{{--                <div class="mb-3">--}}
{{--                    <label>Name</label>--}}
{{--                    <input name="name" type="text" class="form-control" required value="{{ old('name') }}">--}}
{{--                </div>--}}
{{--                <div class="mb-3">--}}
{{--                    <label>Email</label>--}}
{{--                    <input name="email" type="email" class="form-control" required value="{{ old('email') }}">--}}
{{--                </div>--}}
{{--                <div class="mb-3">--}}
{{--                    <label>Password</label>--}}
{{--                    <input name="password" type="password" class="form-control" required>--}}
{{--                </div>--}}
{{--                <div class="mb-3">--}}
{{--                    <label>Confirm Password</label>--}}
{{--                    <input name="password_confirmation" type="password" class="form-control" required>--}}
{{--                </div>--}}
{{--                <button type="submit" class="btn btn-success w-100">Register</button>--}}
{{--            </form>--}}

{{--            <p class="text-center mt-3 mb-0">Already registered?--}}
{{--                <a href="{{ route('login') }}">Login</a>--}}
{{--            </p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
