<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing System</title>

    <!-- Bootstrap 5 CSS -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

    <style>
        .navbar {
            background-color:rgb(9, 146, 130);
        }

        .navbar-brand {
            color: #fff;
            font-weight: bold;
            text-decoration: none;
        }

        .navbar-brand:hover {
            color: #e8e8e8;
        }

        .navbar-nav {
            list-style: none; /* <-- Fix for dots */
            padding-left: 0;   /* <-- Fix for alignment */
            margin-bottom: 0;
        }

        .navbar-nav .nav-link {
            color: #fff;
            font-weight: 500;
            padding: 8px 15px;
            text-decoration: none; /* <-- Remove underline */
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #dcdcdc;
            text-decoration: underline;
            font-weight: 600;
        }

        .alert {
            margin-top: 15px;
        }
    </style>

    @yield('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Billing System</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('dashboard') ? ' active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('customers.*') ? ' active' : '' }}" href="{{ route('customers.index') }}">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('products.*') ? ' active' : '' }}" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('invoices.*') ? ' active' : '' }}" href="{{ route('invoices.index') }}">Invoices</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="container py-4">
        @yield('content')
    </main>

    <!-- Bootstrap 5 JS -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>

    @yield('scripts')
</body>
</html>
