<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Invoice $invoice)
    {
        return view('payments.create', compact('invoice'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|max:255',
            'paid_at' => 'required|date',
        ]);

        // Create the payment
        Payment::create([
            'invoice_id' => $request->invoice_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'paid_at' => $request->paid_at,
        ]);

        // Fetch the invoice
        $invoice = Invoice::findOrFail($request->invoice_id);

        // Calculate total payments made for this invoice
        $totalPayments = $invoice->payments()->sum('amount');

        // Check if the invoice is fully paid
        if ($totalPayments >= $invoice->total_amount) {
            $invoice->status = 'Paid'; // Update status to Paid
            $invoice->save();
        }

        return redirect()->route('invoices.show', $request->invoice_id)
            ->with('success', 'Payment recorded successfully!');
    }
}
