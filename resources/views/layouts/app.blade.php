<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factory Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        /* ===== ROOT COLORS ===== */
        :root {
            --gold: #c9a227;
            --gold-light: #f3e7c3;
            --white-bg: #f9f9f9;
            --card-bg: #ffffff;
            --text-dark: #2b2b2b;
            --border-soft: #e5e5e5;
        }

        body {
            background: linear-gradient(135deg, #ffffff, #f3f3f3);
            min-height: 100vh;
            color: var(--text-dark);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ===== NAVBAR (handled in navbar partial mostly) ===== */
        .navbar {
            background: linear-gradient(90deg, #d4af37, #b8962e);
        }

        .navbar .nav-link,
        .navbar .navbar-brand {
            color: #fff !important;
            font-weight: 500;
        }

        /* ===== CARDS ===== */
        .glass-card,
        .card {
            background: var(--card-bg);
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid var(--border-soft);
        }

        /* ===== TABLES ===== */
        .table-bg {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .table {
            color: var(--text-dark);
        }

        .table thead {
            background: linear-gradient(90deg, #f3e7c3, #e8d48a);
            color: #5a4a1f;
        }

        .table tbody tr:hover {
            background: #faf6ea;
        }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background: linear-gradient(135deg, #d4af37, #b8962e);
            border: none;
            color: #fff;
            border-radius: 8px;
            padding: 8px 16px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #b8962e, #a88424);
        }

        .btn-success {
            background: #2e8b57;
            border: none;
            border-radius: 8px;
        }

        /* ===== FORMS ===== */
        input, textarea, select {
            background: #fff !important;
            color: var(--text-dark) !important;
            border: 1px solid var(--border-soft) !important;
            border-radius: 8px;
        }

        input:focus, textarea:focus, select:focus {
            border-color: var(--gold) !important;
            box-shadow: 0 0 0 0.15rem rgba(201, 162, 39, 0.25);
        }

        /* ===== BADGES ===== */
        .badge {
            border-radius: 20px;
            padding: 6px 12px;
        }

        /* ===== PROGRESS BAR ===== */
        .progress {
            background: #eee;
        }

        .progress-bar {
            background: linear-gradient(90deg, #d4af37, #b8962e);
        }

    </style>
</head>

<body>

{{-- Navbar --}}
@include('partials.navbar')

<div class="d-flex">
    <main class="content-area w-100 p-3">
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Factory Management System</title>--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">--}}
{{--    <style>--}}
{{--        body {--}}
{{--            background: linear-gradient(135deg, #1e1e1e, #2a2a2a);--}}
{{--            min-height: 100vh;--}}
{{--            color: #eaeaea;--}}
{{--        }--}}

{{--        .glass-card {--}}
{{--            background: #2f2f2f;--}}
{{--            border-radius: 12px;--}}
{{--            padding: 25px;--}}
{{--            box-shadow: 0 4px 20px rgba(0,0,0,0.4);--}}
{{--            border: 1px solid rgba(255,255,255,0.05);--}}
{{--        }--}}

{{--        .table-bg {--}}
{{--            background: #2626;--}}
{{--            border-radius: 10px;--}}
{{--            padding: 15px;--}}
{{--        }--}}

{{--        .table thead {--}}
{{--            background: #333;--}}
{{--        }--}}

{{--        .table tbody tr:hover {--}}
{{--            background: rgba(255,255,255,0.05);--}}
{{--        }--}}

{{--        .btn-primary, .btn-success {--}}
{{--            border-radius: 8px;--}}
{{--            padding: 8px 14px;--}}
{{--        }--}}

{{--        input, textarea, select {--}}
{{--            background: #1c1c1c !important;--}}
{{--            color: #fff !important;--}}
{{--            border: 1px solid #444 !important;--}}
{{--        }--}}
{{--    </style>--}}

{{--</head>--}}
{{--<body>--}}

{{-- Include RGB Navbar --}}
{{--@include('partials.navbar')--}}

{{--<div class="d-flex">--}}
{{--    <main class="content-area w-100">--}}
{{--        @yield('content')--}}
{{--    </main>--}}
{{--</div>--}}

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--</body>--}}
{{--</html>--}}
{{--old--}}
{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Factory Management System</title>--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">--}}
{{--    <style>--}}
{{--        body { background-color: #f8f9fa; }--}}
{{--        #sidebar { width: 230px; min-height: 100vh; }--}}
{{--        .content-area { flex: 1; padding: 20px; }--}}
{{--        .navbar-brand { font-weight: bold; }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}


{{--<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">--}}
{{--    <div class="container-fluid">--}}
{{--        <a class="navbar-brand" href="{{ route('dashboard') }}">--}}
{{--            🏭 Factory Management--}}
{{--        </a>--}}
{{--        <button class="btn btn-outline-light d-lg-none" onclick="toggleSidebar()">☰</button>--}}
{{--    </div>--}}
{{--</nav>--}}

{{--<div class="d-flex">--}}

{{--    @include('partials.navbar')--}}


{{--    <main class="content-area">--}}
{{--        @yield('content')--}}
{{--    </main>--}}
{{--</div>--}}

{{--<script>--}}
{{--    function toggleSidebar(){--}}
{{--        document.getElementById('rgb-navbar').classList.toggle('d-none');--}}
{{--    }--}}
{{--</script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--</body>--}}
{{--</html>--}}
{{--    <!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Factory Management System</title>--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <style>--}}
{{--        body {--}}
{{--            overflow-x: hidden;--}}
{{--        }--}}
{{--        .sidebar {--}}
{{--            height: 100vh;--}}
{{--            position: fixed;--}}
{{--            top: 0;--}}
{{--            left: -250px;--}}
{{--            width: 250px;--}}
{{--            background: #343a40;--}}
{{--            color: #fff;--}}
{{--            transition: all 0.3s;--}}
{{--            z-index: 1050;--}}
{{--            padding-top: 60px;--}}
{{--        }--}}
{{--        .sidebar.show {--}}
{{--            left: 0;--}}
{{--        }--}}
{{--        .sidebar a {--}}
{{--            color: #fff;--}}
{{--            padding: 10px 20px;--}}
{{--            display: block;--}}
{{--            text-decoration: none;--}}
{{--        }--}}
{{--        .sidebar a:hover {--}}
{{--            background: #495057;--}}
{{--        }--}}
{{--        .content {--}}
{{--            margin-left: 0;--}}
{{--            transition: margin-left 0.3s;--}}
{{--            padding: 20px;--}}
{{--        }--}}
{{--        .content.shift {--}}
{{--            margin-left: 250px;--}}
{{--        }--}}
{{--        .navbar-dark {--}}
{{--            background: linear-gradient(90deg, #0d6efd, #6610f2);--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<!-- Navbar -->--}}
{{--<nav class="navbar navbar-dark fixed-top">--}}
{{--    <div class="container-fluid">--}}
{{--        <button class="btn btn-outline-light" id="menu-toggle">☰</button>--}}
{{--        <a class="navbar-brand ms-2" href="{{ route('dashboard') }}">--}}
{{--            🏭 Factory Management--}}
{{--        </a>--}}
{{--    </div>--}}
{{--</nav>--}}

{{--<!-- Sidebar -->--}}
{{--<div class="sidebar bg-dark" id="sidebar">--}}
{{--    <a href="{{ route('dashboard') }}">🏠 Dashboard</a>--}}
{{--    <a href="{{ route('articles.index') }}">📦 Articles</a>--}}
{{--    <a href="{{ route('fabrics.index') }}">🧵 Fabrics</a>--}}
{{--    <a href="{{ route('customers.index') }}">👤 Customers</a>--}}
{{--    <a href="{{ route('invoices.index') }}">🧾 Invoices</a>--}}
{{--    <a href="{{ route('production.index') }}">⚙️ Production</a>--}}
{{--</div>--}}


{{--<!-- Content -->--}}
{{--<div class="content" id="content">--}}
{{--    <main class="container-fluid mt-4">--}}
{{--        @yield('content')--}}
{{--    </main>--}}
{{--</div>--}}

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--<script>--}}
{{--    const toggleButton = document.getElementById('menu-toggle');--}}
{{--    const sidebar = document.getElementById('sidebar');--}}
{{--    const content = document.getElementById('content');--}}

{{--    toggleButton.addEventListener('click', () => {--}}
{{--        sidebar.classList.toggle('show');--}}
{{--        content.classList.toggle('shift');--}}
{{--    });--}}
{{--</script>--}}
{{--</body>--}}
{{--</html>--}}
