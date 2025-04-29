<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'amount',
        'payment_method', // ✅ Important to add
        'paid_at',         // ✅ Important to add
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
