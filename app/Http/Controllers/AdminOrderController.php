<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function installments(Order $order)
    {
        return view('admin.orders.installments', [
            'order' => $order,
            'installmentPayments' => $order->installmentPayments
        ]);
    }
}