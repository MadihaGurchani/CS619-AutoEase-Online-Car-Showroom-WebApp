<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'category_id',
        'order_number',
        'order_date',
        'delivery_address',
        'delivery_city',
        'delivery_type',
        'payment_type',
        'installment_months',
        'monthly_installment',  // Added this
        'delivery_charge',
        'total_amount',
        'status',
        'payment_status',
        'last_payment_date',
        'next_payment_date',
        'next_installment_date',  // Added comma here
        'delivery_status',
        'estimated_delivery_date',
        'delivery_notes'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'estimated_delivery_date'
    ];
    protected $casts = [
        'order_date' => 'datetime',
        'installment_details' => 'array',
        'delivery_status' => 'string',
        'estimated_delivery_date' => 'datetime',
        'next_payment_date' => 'datetime',
        'last_payment_date' => 'datetime'
    ];
    public const STATUSES = [
        'pending',
        'processing',
        'shipped',
        'delivered',
        'completed',
        'cancelled'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function installmentPayments()
    {
        return $this->hasMany(InstallmentPayment::class);
    }

    public function calculateInstallments()
    {
        if ($this->payment_type !== 'installment') {
            return null;
        }

        $totalAmount = $this->car->price;
        $monthlyAmount = $totalAmount / $this->installment_months;
        $startDate = $this->created_at;

        $installments = [];
        for ($i = 1; $i <= $this->installment_months; $i++) {
            $installments[] = [
                'installment_number' => $i,
                'amount' => $monthlyAmount,
                'due_date' => $startDate->copy()->addMonths($i)->format('Y-m-d'),
                'status' => 'pending',
                'payment_date' => null
            ];
        }

        return $installments;
    }

    public function getNextPaymentDateAttribute()
    {
        if ($this->payment_type !== 'installment') {
            return null;
        }

        $installments = $this->installment_details ?? [];
        foreach ($installments as $installment) {
            if ($installment['status'] === 'pending') {
                return Carbon::parse($installment['due_date']);
            }
        }

        return null;
    }

    public function updatePaymentStatus($installmentNumber, $status = 'paid')
    {
        $installments = $this->installment_details ?? [];
        
        foreach ($installments as &$installment) {
            if ($installment['installment_number'] === $installmentNumber) {
                $installment['status'] = $status;
                $installment['payment_date'] = now()->format('Y-m-d');
                break;
            }
        }

        $this->installment_details = $installments;
        $this->last_payment_date = now();
        $this->save();
    }

    public function getDeliveryStatusAttribute()
    {
        return $this->attributes['delivery_status'] ?? 'processing';
    }

    public function updateDeliveryStatus($status)
    {
        $this->delivery_status = $status;
        $this->save();
    }
    


}
