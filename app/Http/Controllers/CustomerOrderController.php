<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
                      ->with(['car.brand'])
                      ->latest()
                      ->get();
        
        return view('customer.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'payment_type' => 'required|in:full,installment',
            'delivery_type' => 'required|in:pickup,doorstep',
            'installment_months' => 'required_if:payment_type,installment|in:3,6,12',
            'delivery_city' => 'required_if:delivery_type,doorstep',
            'delivery_address' => 'required_if:delivery_type,doorstep',
        ]);

        $car = Car::findOrFail($request->car_id);
        
        // Generate a unique order number
        $orderNumber = 'ORD-' . time() . '-' . auth()->id();
        
        $order = new Order();
        $order->user_id = auth()->id();
        $order->car_id = $request->car_id;
        $order->category_id = $car->brand->id;
        $order->order_number = $orderNumber;
        $order->order_date = now();
        $order->payment_type = $request->payment_type;
        $order->delivery_type = $request->delivery_type;
        
        // Handle delivery details
        if ($request->delivery_type === 'doorstep') {
            $order->delivery_city = $request->delivery_city;
            $order->delivery_address = $request->delivery_address;
            
            // Set delivery charges based on city
            $deliveryCharges = [
                'Karachi' => 5000,
                'Lahore' => 10000,
                'Islamabad' => 15000,
                'Peshawar' => 20000,
                'Quetta' => 25000
            ];
            $order->delivery_charge = $deliveryCharges[$request->delivery_city] ?? 0;
        } else {
            // For pickup orders
            $order->delivery_city = 'Karachi';
            $order->delivery_address = 'Main Showroom, Karachi';
            $order->delivery_charge = 0;
        }

        // Handle payment details
        if ($request->payment_type === 'installment') {
            $order->installment_months = $request->installment_months;
            $order->monthly_installment = $car->price / $request->installment_months;
            $order->next_installment_date = now()->addMonth();
        }

        // Calculate total amount
        $order->total_amount = $car->price + $order->delivery_charge;
        
        // Set initial statuses
        $order->status = 'pending';
        $order->payment_status = 'pending';
        
        // Save the order
        $order->save();

        // Update car status to sold or reserved
        $car->status = 'sold';
        $car->save();

        return redirect()->route('customer.orders.index')
            ->with('success', 'Order placed successfully!');
    }

    public function cancel(Order $order)
    {
        if (!$order->canBeCancelled()) {
            return back()->with('error', 'Orders can only be cancelled within 24 hours of booking.');
        }

        $order->update(['status' => 'cancelled']);
        return back()->with('success', 'Order cancelled successfully.');
    }
}