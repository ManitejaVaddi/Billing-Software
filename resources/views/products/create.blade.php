@extends('layouts.app')

@section('content')
    <h1>Create New Product</h1>

    <form action="{{ route('products.store') }}" method="POST" class="form-container">
        @csrf

        <table class="table-form">
            <tr>
                <td><label for="name">Product Name</label></td>
                <td><input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required></td>
            </tr>
            <tr>
                <td><label for="description">Description</label></td>
                <td><textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea></td>
            </tr>
            <tr>
                <td><label for="price">Price</label></td>
                <td><input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price') }}" required></td>
            </tr>
            <tr>
                <td><label for="stock">Stock</label></td>
                <td><input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" required></td>
            </tr>
            <tr>
                <td colspan="2" class="form-group">
                    <button type="submit" class="btn btn-primary">Create Product</button>
                </td>
            </tr>
        </table>
    </form>
@endsection

@section('styles')
    <style>
        /* Form container to add some padding and margin */
        .form-container {
            width: 60%;
            margin: 0 auto;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 2rem;
        }

        /* Table form layout */
        .table-form {
            width: 100%;
            border-collapse: collapse;
        }

        /* Style for table cells */
        .table-form td {
            padding: 12px;
            vertical-align: middle;
            font-size: 1rem;
        }

        .table-form label {
            font-weight: bold;
            color: #333;
        }

        /* Input and textarea styles */
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }

        .table-form textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Submit button styling */
        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        /* Button hover effect */
        .btn-primary:hover {
            background-color: #45a049;
        }
    </style>
@endsection
