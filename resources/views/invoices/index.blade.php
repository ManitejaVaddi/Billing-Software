@extends('layouts.app')

@section('styles')
    <style>
        /* Your exact original CSS */
        .invoice-container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .btn {
            padding: 8px 16px;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin: 4px;
            border: none;
        }

        .btn-primary {
            background-color: rgb(11, 161, 56);
            color: white;
        }

        .btn-primary:hover {
            background-color: #2779bd;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-danger {
            background-color: #e3342f;
            color: white;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .table th {
            background-color: #f0f0f0;
            color: #333;
        }

        form {
            display: inline;
        }
    </style>
@endsection

@section('content')
<div class="invoice-container">
    <h1>All Invoices</h1>

    <div style="text-align: right; margin-bottom: 20px;">
        <a href="{{ route('invoices.create') }}" class="btn btn-primary">Create New Invoice</a>
    </div>

    @if(session('success'))
        <div style="background-color: #d4edda; padding: 10px; border-radius: 5px; margin-bottom: 20px; color: #155724;">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->customer->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y') }}</td>
                    <td>${{ number_format($invoice->total, 2) }}</td>
                    <td>{{ ucfirst($invoice->status ?? 'pending') }}</td>
                    <td>
                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this invoice?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No invoices found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
