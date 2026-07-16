<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Dashboard') - Sport Venue Management</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Template Main CSS File (NiceAdmin standard) -->
    <style>
        :root {
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #6f42c1;
            --bs-pink: #d63384;
            --bs-red: #dc3545;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffc107;
            --bs-green: #198754;
            --bs-teal: #20c997;
            --bs-cyan: #0dcaf0;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-gray-100: #f8f9fa;
            --bs-gray-200: #e9ecef;
            --bs-gray-300: #dee2e6;
            --bs-gray-400: #ced4da;
            --bs-gray-500: #adb5bd;
            --bs-gray-600: #6c757d;
            --bs-gray-700: #495057;
            --bs-gray-800: #343a40;
            --bs-gray-900: #212529;
            --bs-primary: #012970; /* Biru Navy */
            --bs-secondary: #f6f9ff;
            --bs-success: #198754; /* Hijau */
            --bs-info: #0dcaf0;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f6f9ff;
            --bs-dark: #212529;
            --bs-light-gray: #f6f9ff; /* Abu muda */
        }
        
        body {
            font-family: "Open Sans", sans-serif;
            background-color: var(--bs-light-gray);
            color: #444444;
        }

        a {
            color: var(--bs-primary);
            text-decoration: none;
        }

        a:hover {
            color: #717ff5;
            text-decoration: none;
        }
        
        /* Header */
        .header {
            transition: all 0.5s;
            z-index: 997;
            height: 60px;
            box-shadow: 0px 2px 20px rgba(1, 41, 112, 0.1);
            background-color: var(--bs-white);
            padding-left: 20px;
        }
        
        .header .logo {
            line-height: 1;
        }
        
        .header .logo span {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--bs-primary);
            font-family: "Nunito", sans-serif;
            margin-top: 3px;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            bottom: 0;
            width: 250px;
            z-index: 996;
            transition: all 0.3s;
            padding: 20px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #aab7cf transparent;
            box-shadow: 0px 0px 20px rgba(1, 41, 112, 0.1);
            background-color: var(--bs-white);
        }
        
        .sidebar-nav {
            padding: 0;
            margin: 0;
            list-style: none;
        }
        
        .sidebar-nav li {
            padding: 0;
            margin: 0;
            list-style: none;
        }
        
        .sidebar-nav .nav-item {
            margin-bottom: 5px;
        }
        
        .sidebar-nav .nav-heading {
            font-size: 11px;
            text-transform: uppercase;
            color: #899bbd;
            font-weight: 600;
            margin: 10px 0 5px 15px;
        }
        
        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            font-size: 15px;
            font-weight: 600;
            color: var(--bs-primary);
            transition: 0.3;
            background: var(--bs-light-gray);
            padding: 10px 15px;
            border-radius: 4px;
        }
        
        .sidebar-nav .nav-link i {
            font-size: 16px;
            margin-right: 10px;
            color: var(--bs-primary);
        }
        
        .sidebar-nav .nav-link.collapsed {
            color: var(--bs-primary);
            background: var(--bs-white);
        }
        
        .sidebar-nav .nav-link.collapsed i {
            color: #899bbd;
        }
        
        .sidebar-nav .nav-link:hover {
            color: var(--bs-primary);
            background: var(--bs-light-gray);
        }
        
        .sidebar-nav .nav-link:hover i {
            color: var(--bs-primary);
        }
        
        .sidebar-nav .nav-content {
            padding: 5px 0 0 0;
            margin: 0;
            list-style: none;
        }
        
        .sidebar-nav .nav-content a {
            display: flex;
            align-items: center;
            font-size: 14px;
            font-weight: 600;
            color: var(--bs-primary);
            transition: 0.3;
            padding: 10px 0 10px 40px;
            transition: 0.3s;
        }
        
        .sidebar-nav .nav-content a i {
            font-size: 6px;
            margin-right: 8px;
            line-height: 0;
            border-radius: 50%;
        }
        
        .sidebar-nav .nav-content a:hover, .sidebar-nav .nav-content a.active {
            color: var(--bs-primary);
        }
        
        /* Main Content */
        #main {
            margin-left: 250px;
            padding: 20px 30px;
            transition: all 0.3s;
            margin-top: 60px;
        }
        
        .pagetitle {
            margin-bottom: 10px;
        }
        
        .pagetitle h1 {
            font-size: 24px;
            margin-bottom: 0;
            font-weight: 600;
            color: var(--bs-primary);
        }
        
        .card {
            margin-bottom: 30px;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 0 30px rgba(1, 41, 112, 0.1);
        }
        
        .card-header {
            border-bottom: 1px solid #ebeef4;
            background-color: var(--bs-white);
            color: var(--bs-primary);
            font-size: 18px;
            font-weight: 500;
            padding: 15px 20px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        /* Utility */
        .text-navy {
            color: var(--bs-primary) !important;
        }
    </style>
</head>
<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">SportVenue</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn ps-3 text-navy fs-3"></i>
        </div>
        
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center mb-0 pe-3">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=012970&color=fff" alt="Profile" class="rounded-circle" style="height: 36px; width: 36px;">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->
                    
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>{{ Auth::user()->role }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center text-danger">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </li>
                    </ul><!-- End Profile Dropdown Items -->
                </li>
            </ul>
        </nav>
    </header>

    <!-- ======= Sidebar ======= -->
    @include('layouts.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>@yield('title')</h1>
        </div>

        <section class="section dashboard mt-3">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @yield('content')
        </section>
    </main>

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
