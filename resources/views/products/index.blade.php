@extends('layouts.app')

@section('styles')
    <style>
        .product-container {
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
<div class="product-container">
    <h1>Products</h1>
    <a href="{{ route('products.create') }}" class="create-btn">Create New Product</a>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock ?? 0 }}</td> <!-- Display stock or 0 if null -->
                    <td class="actions">
                        <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
