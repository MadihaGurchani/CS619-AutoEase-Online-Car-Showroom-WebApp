<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentPayment extends Model
{
    protected $fillable = [
        'order_id',
        'installment_number',
        'amount',
        'due_date',
        'payment_date',
        'status'
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'due_date' => 'datetime'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
