<nav id="rgb-navbar" class="navbar navbar-expand-lg navbar-dark sticky-top shadow">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="36" onerror="this.style.display='none'">
            <span class="ms-2 fw-bold">🏭 Factory Management</span>
        </a>

        <!-- Toggler for mobile -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">

                <!-- Main Links -->
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fa fa-home me-2"></i>Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('articles.index') }}"><i class="fa fa-file-alt me-2"></i>Articles</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('fabrics.index') }}"><i class="fa fa-layer-group me-2"></i>Fabrics</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('accessories.index') }}"><i class="fa fa-cogs me-2"></i>Accessories</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('transactions.index') }}"><i class="fa fa-exchange-alt me-2"></i>Inventory</a></li>
{{--                <li class="nav-item"><a class="nav-link" href="{{ route('production.index') }}"><i class="fa fa-industry me-2"></i>Production</a></li>--}}
                <li class="nav-item"><a class="nav-link" href="{{ route('invoices.index') }}"><i class="fa fa-file-invoice-dollar me-2"></i>Invoices</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('customers.index') }}"><i class="fa fa-users me-2"></i>Customers</a></li>

                <!-- Divider for small screens -->
                <li class="nav-item d-lg-none"><hr class="text-white-50 my-2"></li>

                <!-- User Auth Info -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user-circle me-1"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fa fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger"><i class="fa fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-outline-light ms-lg-3" href="{{ route('login') }}">
                            <i class="fa fa-sign-in-alt me-2"></i>Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>

    <!-- Style -->
    <style>
        /* 🌈 RGB Gradient Animation */
        #rgb-navbar {
            background: linear-gradient(90deg, #0ea5e9 0%, #7c3aed 33%, #ef4444 66%, #f59e0b 100%);
            background-size: 300% 300%;
            animation: rgbShift 10s ease infinite;
        }

        @keyframes rgbShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* 🔤 Text & Icons */
        #rgb-navbar .nav-link {
            color: rgba(255,255,255,0.95) !important;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }
        #rgb-navbar .nav-link:hover {
            color: #fff !important;
            transform: translateY(-1px);
        }
        #rgb-navbar .navbar-brand span {
            color: #fff;
            font-size: 1.05rem;
            letter-spacing: 0.3px;
        }

        /* 🌙 Dropdown Styling */
        .dropdown-menu {
            border-radius: 12px;
            padding: 0.5rem 0;
        }
        .dropdown-item {
            font-size: 0.9rem;
            padding: 0.6rem 1rem;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
    </style>
</nav>
{{--<nav id="rgb-navbar" class="navbar navbar-expand-lg navbar-dark sticky-top">--}}
{{--    <div class="container-fluid">--}}
{{--        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">--}}
{{--            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="36" onerror="this.style.display='none'">--}}
{{--            <span class="ms-2 fw-bold">  🏭 Factory Management System</span>--}}
{{--        </a>--}}

{{--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}

{{--        <div class="collapse navbar-collapse" id="mainNav">--}}
{{--            <ul class="navbar-nav ms-auto">--}}
{{--                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fa fa-home me-2"></i>Home</a></li>--}}
{{--                <li class="nav-item"><a class="nav-link" href="{{ route('articles.index') }}"><i class="fa fa-file-alt me-2"></i> Articles</a></li>--}}
{{--                <li class="nav-item"><a class="nav-link" href="{{ route('fabrics.index') }}"><i class="fa fa-layer-group me-2"></i>Fabrics</a></li>--}}
{{--                <li class="nav-item"><a class="nav-link" href="{{ route('accessories.index') }}"><i class="fa fa-cogs me-2"></i>Accessories</a></li>--}}
{{--                <li class="nav-item"><a class="nav-link" href="{{ route('transactions.index') }}"><i class="fa fa-exchange-alt me-2"></i>Inventory</a></li>--}}
{{--                <li class="nav-item"><a class="nav-link" href="{{ route('production.index') }}"><i class="fa fa-industry me-2"></i>Production</a></li>--}}
{{--                <li class="nav-item"><a class="nav-link" href="{{ route('invoices.index') }}"><i class="fa fa-file-invoice-dollar me-2"></i>Invoices</a></li>--}}
{{--                <li class="nav-item"><a class="nav-link" href="{{ route('customers.index') }}"><i class="fa fa-users me-2"></i>Customers</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <style>--}}
{{--        /* RGB animated gradient navbar */--}}
{{--        #rgb-navbar {--}}
{{--            background: linear-gradient(90deg, #0ea5e9 0%, #7c3aed 33%, #ef4444 66%, #f59e0b 100%);--}}
{{--            background-size: 300% 300%;--}}
{{--            animation: rgbShift 10s ease infinite;--}}
{{--            box-shadow: 0 6px 20px rgba(0,0,0,0.12);--}}
{{--        }--}}
{{--        @keyframes rgbShift {--}}
{{--            0% { background-position: 0% 50%;}--}}
{{--            50% { background-position: 100% 50%;}--}}
{{--            100% { background-position: 0% 50%;}--}}
{{--        }--}}
{{--        #rgb-navbar .nav-link { color: rgba(255,255,255,0.95) !important; }--}}
{{--        #rgb-navbar .navbar-brand span { color: #fff; }--}}
{{--    </style>--}}
{{--</nav>--}}

