@extends('layouts.app')

@section('styles')
    <style>
        .customer-container {
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

        .create-btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .create-btn:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        a, button {
            margin: 0 4px;
        }

        .actions form {
            display: inline;
        }

        button {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
        }

        button[type="submit"] {
            background-color: #e3342f;
        }

        a[href*="edit"] {
            background-color: #ffc107;
            color: #212529;
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
        }

        a[href*="edit"]:hover {
            background-color: #e0a800;
        }
    </style>
@endsection

@section('content')
<div class="customer-container">
    <h1>Customers</h1>
    <a href="{{ route('customers.create') }}" class="create-btn">Create New Customer</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td class="actions">
                        <a href="{{ route('customers.edit', $customer->id) }}">Edit</a>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
