@extends('layouts.app')

@section('styles')
<style>
    body {
        background-color: #f3f4f6;
    }

    .dashboard-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 30px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
    }

    .dashboard-title {
        text-align: center;
        font-size: 2.4rem;
        font-weight: 700;
        margin-bottom: 40px;
        color: #185a9d;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }

    .card {
        background-color: #f9fafb;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    .card-icon {
        font-size: 3rem;
        color: #43cea2;
        margin-bottom: 15px;
    }

    .card h2 {
        font-size: 1.6rem;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .card p {
        color: #555;
        font-size: 1rem;
        margin-bottom: 20px;
    }

    .card a {
        display: inline-block;
        padding: 10px 20px;
        background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
        color: white;
        text-decoration: none;
        border-radius: 6px;
        transition: background-color 0.3s;
    }

    .card a:hover {
        background: linear-gradient(90deg, #185a9d 0%, #43cea2 100%);
    }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection

@section('content')
    <div class="dashboard-container">
        <h1 class="dashboard-title">Welcome to Your Dashboard</h1>

        <div class="dashboard-grid">
            <div class="card">
                <div class="card-icon">
                    <i class="bi bi-people-fill"></i> <!-- Customers Icon -->
                </div>
                <h2>Customers</h2>
                <p>Manage all your customers</p>
                <a href="{{ route('customers.index') }}">View</a>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="bi bi-box-seam"></i> <!-- Products Icon -->
                </div>
                <h2>Products</h2>
                <p>View and update your product list</p>
                <a href="{{ route('products.index') }}">View</a>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="bi bi-receipt-cutoff"></i> <!-- Invoices Icon -->
                </div>
                <h2>Invoices</h2>
                <p>Create and manage invoices</p>
                <a href="{{ route('invoices.index') }}">View</a>
            </div>
        </div>
    </div>
@endsection
