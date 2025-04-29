@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Success message after recording payment -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Invoice #{{ $invoice->id }}</h2>
    <p><strong>Customer:</strong> {{ $invoice->customer->name }}</p>
    <p><strong>Date:</strong> {{ $invoice->invoice_date }}</p>
    <p><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>

    <h4>Items</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total: ${{ number_format($invoice->total, 2) }}</h4>

    <!-- Add Payment Button -->
    <a href="{{ route('payments.create', $invoice->id) }}" class="btn btn-primary mt-4">Add Payment</a>

    <!-- Payments Section -->
    @if($invoice->payments->count() > 0)
        <h4 class="mt-5">Payments</h4>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Paid At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->payments as $payment)
                    <tr>
                        <td>${{ number_format($payment->amount, 2) }}</td>
                        <td>{{ $payment->payment_method }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->paid_at)->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
