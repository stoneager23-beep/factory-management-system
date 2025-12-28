<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factory Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .content-area { flex: 1; padding: 20px; }
    </style>
</head>
<body>

{{-- Include RGB Navbar --}}
{{--@include('partials.navbar')--}}

<div class="d-flex">
    <main class="content-area w-100">
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
