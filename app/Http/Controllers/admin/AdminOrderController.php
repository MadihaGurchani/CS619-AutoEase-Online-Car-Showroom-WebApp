<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminOrderController extends Controller
{
    public function installments(Order $order)
    {
        $installments = $order->calculateInstallments();
        return view('admin.orders.installments', [
            'order' => $order,
            'installments' => $installments
        ]);
    }

    public function updateInstallment(Order $order, Request $request)
    {
        $installmentNumber = $request->input('installment_number');
        
        // Update order payment status
        if ($installmentNumber == $order->installment_months) {
            $order->payment_status = 'paid';
            $order->next_payment_date = null;
        } else {
            $order->payment_status = 'partially_paid';
            $order->next_payment_date = Carbon::now()->addMonth();
        }
        
        $order->last_payment_date = Carbon::now();
        $order->save();
        
        return redirect()->back()->with('success', 'Installment payment recorded successfully');
    }
}