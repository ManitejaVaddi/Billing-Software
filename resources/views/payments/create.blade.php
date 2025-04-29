@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Payment for Invoice #{{ $invoice->id }}</h1>

        <form action="{{ route('payments.store') }}" method="POST" class="form-container">
            @csrf
            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">

            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control" required step="0.01" min="0">
            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <input type="text" name="payment_method" id="payment_method" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="paid_at">Paid At</label>
                <input type="date" name="paid_at" id="paid_at" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">Record Payment</button>
        </form>
    </div>
@endsection
