@extends('layouts.app')

@section('styles')
    <style>
        /* Your original CSS exactly */
        .invoice-container {
            max-width: 900px;
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

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
            color: #444;
        }

        input, select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        #items-table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        #items-table th, #items-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        #items-table th {
            background-color: #f0f0f0;
            color: #333;
        }

        .btn {
            padding: 10px 18px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .btn-danger {
            background-color: #e74c3c;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .total-box {
            text-align: right;
            margin-top: 20px;
        }

        .total-box label {
            margin-right: 10px;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .total-box input {
            width: 150px;
            text-align: right;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .remove-row {
            font-size: 16px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
<div class="invoice-container">
    <h1>Create New Invoice</h1>

    {{-- Display validation errors --}}
    @if($errors->any())
        <div style="background-color: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 20px; color: #721c24;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select name="customer_id" id="customer_id" required>
                <option value="">-- Select Customer --</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="invoice_date">Invoice Date</label>
            <input type="date" name="invoice_date" id="invoice_date" required>
        </div>

        <h3>Invoice Items</h3>
        <table id="items-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="items[0][product_id]" class="product-select" required>
                            <option value="">-- Select Product --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="items[0][quantity]" class="qty" value="1" min="1" required></td>
                    <td><input type="text" name="items[0][price]" class="price" readonly></td>
                    <td><input type="text" name="items[0][total]" class="total" readonly></td>
                    <td><button type="button" class="remove-row">X</button></td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn" id="add-row">Add Another Item</button>

        <div class="total-box">
            <label for="total">Total:</label>
            <input type="text" id="display-total" readonly>
            <input type="hidden" name="total" id="total">
        </div>

        <button type="submit" class="btn">Save Invoice</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    let rowIndex = 1;

    function updateTotals() {
        let overallTotal = 0;
        document.querySelectorAll('#items-table tbody tr').forEach(row => {
            const qty = parseFloat(row.querySelector('.qty')?.value || 0);
            const select = row.querySelector('.product-select');
            const price = parseFloat(select?.selectedOptions[0]?.dataset.price || 0);
            const lineTotal = qty * price;

            row.querySelector('.price').value = price.toFixed(2);
            row.querySelector('.total').value = lineTotal.toFixed(2);

            overallTotal += lineTotal;
        });

        document.getElementById('display-total').value = overallTotal.toFixed(2);
        document.getElementById('total').value = overallTotal.toFixed(2);
    }

    document.getElementById('add-row').addEventListener('click', () => {
        const table = document.querySelector('#items-table tbody');
        const newRow = table.rows[0].cloneNode(true);

        newRow.querySelectorAll('input, select').forEach(input => {
            if (input.name) {
                input.name = input.name.replace(/\d+/, rowIndex);
            }
            if (input.tagName === 'INPUT') {
                if (input.classList.contains('qty')) input.value = 1;
                else input.value = '';
            } else if (input.tagName === 'SELECT') {
                input.selectedIndex = 0;
            }
        });

        table.appendChild(newRow);
        rowIndex++;
        updateTotals();
    });

    document.addEventListener('change', e => {
        if (e.target.classList.contains('qty') || e.target.classList.contains('product-select')) {
            updateTotals();
        }
    });

    document.addEventListener('click', e => {
        if (e.target.classList.contains('remove-row')) {
            const rows = document.querySelectorAll('#items-table tbody tr');
            if (rows.length > 1) {
                e.target.closest('tr').remove();
                updateTotals();
            }
        }
    });

    updateTotals();
</script>
@endsection
